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

                    <div>
                        <p class="font-barlow mt-4 text-base text-slate-800">
                            {{ $article->body }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
