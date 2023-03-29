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
    protected $with = ['author', 'category', 'tags'];

    protected $casts = [
        'created_at' => 'date: d M Y',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }

    public function author()
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

    public function scopeGetByUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeSearch($query, array $searches)
    {
        $query->when($searches['q'] ?? false, function ($query, $search) {
            return $query->where(
                function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhere('body', 'like', "%$search%");
                }
            );
        });

        $query->when($searches['category'] ?? false, function ($query, $category) {
            return $query->whereHas(
                'category',
                function ($query) use ($category) {
                    $query->where('name', $category);
                }
            );
        });

        $query->when($searches['tags'] ?? false, function ($query, $tags) {
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

        $query->when($searches['author'] ?? false, function ($query, $author) {
            return $query->whereHas(
                'author',
                function ($query) use ($author) {
                    $query->where('name', 'like', "%$author%");
                }
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