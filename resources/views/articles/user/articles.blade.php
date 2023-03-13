<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('My Article') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-2.5 sm:px-6 lg:px-8">
            <div class="mb-5 flex justify-end">
                <a href="/articles/create">
                    <button type="button"
                        class="inline-flex items-center rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white ring-blue-300 transition duration-150 ease-in-out hover:bg-blue-700 focus:border-blue-800 focus:outline-none focus:ring">
                        Create
                    </button>
                </a>
            </div>

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
                            <div class="flex items-center gap-x-1">
                                <form action="{{ route('articles.destroy', $article->slug) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin untuk menghapusnya?')"
                                        class="rounded bg-rose-500 p-1 text-2xl hover:bg-rose-600">
                                        <span>
                                            <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
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
                                    class="inline-flex items-center rounded bg-sky-500 p-1 text-2xl text-white hover:bg-sky-600">
                                    <span>
                                        <svg fill="#fff" class="h-6 w-6" viewBox="0 0 32 32" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
