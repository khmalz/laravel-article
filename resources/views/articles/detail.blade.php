<x-app-layout>
    <x-slot name="header">
        @auth
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ auth()->user()->name == $article->user->name ? __('My Article') : __('Article') }}</h2>
        @else
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('Article') }}</h2>
        @endauth
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-2.5 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="border-b border-gray-200 p-6">
                    <h1 class="text-3xl font-bold">{{ $article->title }}</h1>
                    <div>
                        <h3 class="text-sm text-gray-500/90">
                            By {{ $article->user->name }}
                        </h3>
                        <h3 class="text-xs text-gray-500/90">
                            Published at {{ $article->created_at }}
                        </h3>
                    </div>

                    @hasrole('Super Admin|User')
                        @if (auth()->user()->hasRole('Super Admin') || auth()->id() == $article->user_id)
                            <div class="mt-2 flex items-center gap-x-1">
                                <form action="{{ route('articles.destroy', $article->slug) }}" method="post"
                                    class="inline-flex items-center">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin untuk menghapusnya?')"
                                        class="rounded bg-rose-500 p-1 text-base hover:bg-rose-600">
                                        <span>
                                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M3 4L5.30343 18.0765C5.54671 19.5633 6.60471 20.7872 8.04061 21.2431L8.36905 21.3473C10.7316 22.0973 13.2684 22.0973 15.6309 21.3473L15.9594 21.2431C17.3953 20.7872 18.4533 19.5633 18.6966 18.0765L21 4"
                                                        stroke="#fff" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <ellipse cx="12" cy="4" rx="9" ry="2"
                                                        stroke="#fff" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></ellipse>
                                                </g>
                                            </svg>
                                        </span>
                                    </button>
                                </form>
                                <a href="/articles/{{ $article->slug }}/edit"
                                    class="inline-flex items-center rounded bg-sky-500 p-1 text-base text-white hover:bg-sky-600">
                                    <span>
                                        <svg fill="#fff" class="h-5 w-5" viewBox="0 0 32 32" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>pen</title>
                                                <path
                                                    d="M31.25 7.003c0-0 0-0.001 0-0.001 0-0.346-0.14-0.659-0.365-0.886l-5-5c-0.227-0.226-0.539-0.366-0.885-0.366s-0.658 0.14-0.885 0.366v0l-20.999 20.999c-0.146 0.146-0.256 0.329-0.316 0.532l-0.002 0.009-2 7c-0.030 0.102-0.048 0.22-0.048 0.342 0 0.691 0.559 1.251 1.25 1.252h0c0.126-0 0.248-0.019 0.363-0.053l-0.009 0.002 6.788-2c0.206-0.063 0.383-0.17 0.527-0.311l-0 0 21.211-21c0.229-0.226 0.37-0.539 0.371-0.886v-0zM8.133 26.891l-4.307 1.268 1.287-4.504 14.891-14.891 3.219 3.187zM25 10.191l-3.228-3.196 3.228-3.228 3.229 3.228z">
                                                </path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        @endif
                    @endhasrole

                    <div>
                        <p class="font-barlow mt-4 text-base text-slate-800">
                            {{ $article->body }}
                        </p>
                    </div>

                    <div class="mt-10 flex flex-col gap-y-3">
                        <div class="w-100 flex gap-x-2">
                            <h5 class="min-w-[60px] text-sm">Category</h5>
                            <span
                                class="mr-2 rounded bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">{{ $article->category->name }}</span>
                        </div>
                        <div class="w-100 flex gap-x-2">
                            <h5 class="min-w-[60px] text-sm">Tag</h5>
                            <div class="flex flex-wrap gap-y-1">
                                @foreach ($article->tags as $tag)
                                    <span
                                        class="mr-2 rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
