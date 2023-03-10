<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('All Article') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-2.5 sm:px-6 lg:px-8">
            <div class="grid justify-center gap-x-4 gap-y-7 md:grid-cols-2 md:justify-start lg:grid-cols-3">
                @foreach ($articles as $article)
                    <div
                        class="flex max-w-lg flex-col flex-wrap items-start justify-between self-stretch rounded-lg border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <span
                            class="mb-2 rounded bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">{{ $article->category->name }}</span>
                        <a href="articles/{{ $article->slug }}">
                            <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $article->title }}</h1>
                        </a>
                        <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400 sm:text-base">
                            {{ $article->body }}</p>
                        <div class="flex w-full items-center justify-between">
                            <h5 class="text-xs tracking-tight text-gray-500 dark:text-white sm:text-sm">By
                                {{ $article->user->name }}</h5>
                            <a href="articles/{{ $article->slug }}"
                                class="inline-flex items-center rounded-lg bg-blue-700 py-2 px-3 text-center text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Read
                                More
                                <svg aria-hidden="true" class="ml-2 -mr-1 h-5 w-5" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fillRule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clipRule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
