<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];
    protected $with = ['user', 'category', 'tags'];

    protected $casts = [
        'created_at' => 'date: d M Y',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeSearch($query, array $search)
    {
        $query->when($search['q'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%");
        });

        $query->when($search['category'] ?? false, function ($query, $category) {
            return $query->whereHas(
                'category',
                function ($query) use ($category) {
                    $query->where('name', $category);
                }
            );
        });

        $query->when($search['tags'] ?? false, function ($query, $tags) {
            return $query->whereHas(
                'tags',
                function ($query) use ($tags) {
                    $query->whereIn('name', $tags);
                }
                ,
                "=",
                count($tags)
            );
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}