<x-app-layout>
    <x-slot name="css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('All Article') }}
            @if (request('category') && request('tag'))
                in {{ request('category') }} & {{ request('tag') }}
            @else
                @if (request('category'))
                    in {{ request('category') }}
                @endif

                @if (request('tag'))
                    in {{ request('tag') }}
                @endif
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-2.5 sm:px-6 lg:px-8">
            <div class="mx-auto mb-5 max-w-2xl">
                <form method="GET" action="{{ url()->current() }}">
                    <div class="flex">
                        <label for="search-query"
                            class="sr-only mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                        <button data-modal-target="small-modal" data-modal-toggle="small-modal"
                            class="z-10 inline-flex flex-shrink-0 items-center rounded-l-lg border border-gray-300 bg-gray-100 py-2.5 px-4 text-center text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                            type="button">Filters</button>

                        <div class="relative w-full">
                            <input type="search" id="search-query"
                                class="z-20 block w-full rounded-r-lg border border-l-2 border-gray-300 border-l-gray-50 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:border-l-gray-700 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500"
                                placeholder="Search Article..." name="q" value="{{ request('q') }}">
                            <button type="submit" id="search-submit"
                                class="absolute top-0 right-0 rounded-r-lg border border-blue-700 bg-blue-700 p-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>

                        <!-- Small Modal -->
                        <div id="small-modal" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0 md:h-full">
                            <div class="relative h-full w-full max-w-md md:h-auto">
                                <!-- Modal content -->
                                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="rounded-t border-b p-5 dark:border-gray-600">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                            Filters
                                        </h3>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="space-y-6 p-6">
                                        <div>
                                            <h4>
                                                Categories
                                            </h4>
                                            <div class="mb-4 flex flex-col justify-center">
                                                @foreach ($categories as $category)
                                                    <label for="{{ $category->slug }}"
                                                        class="ml-2 flex items-center gap-x-1 text-sm font-medium text-gray-900 dark:text-gray-300"><input
                                                            id="{{ $category->slug }}" type="radio"
                                                            {{ request('category') == $category->name ? 'checked' : '' }}
                                                            value="{{ $category->name }}" name="category"
                                                            class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">{{ $category->name }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <h4>
                                                Tags
                                            </h4>
                                            <div class="mb-4 flex flex-col justify-center">
                                                @foreach ($tags as $tag)
                                                    <label for="{{ $tag->slug }}"
                                                        class="ml-2 flex items-center gap-x-1 text-sm font-medium text-gray-900 dark:text-gray-300"><input
                                                            id="{{ $tag->slug }}" type="checkbox"
                                                            {{ in_array($tag->name, request('tags') ?? []) ? 'checked' : '' }}
                                                            value="{{ $tag->name }}" name="tags[]"
                                                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">{{ $tag->name }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                                        <button type="submit" id="filterSubmit"
                                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                        <button type="reset" onclick="location.href ='{{ url()->current() }}'"
                                            class="rounded-lg border border-rose-200 bg-white px-5 py-2.5 text-sm font-medium text-rose-500 hover:bg-rose-100 hover:text-rose-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-rose-200 dark:border-rose-500 dark:bg-rose-700 dark:text-rose-300 dark:hover:bg-rose-600 dark:hover:text-white dark:focus:ring-rose-600">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            @if ($articles->isEmpty())
                <div class="flex items-center justify-center overflow-hidden bg-white p-8 shadow-md sm:rounded-lg">
                    Data Not Found
                </div>
            @else
                <div class="grid justify-center gap-x-4 gap-y-7 md:grid-cols-2 md:justify-start lg:grid-cols-3">
                    @foreach ($articles as $article)
                        <div
                            class="flex max-w-lg flex-col flex-wrap items-start justify-between self-stretch rounded-lg border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800">
                            <a href="all-articles?category={{ $article->category->name }}"
                                class="mb-2 rounded bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800 hover:underline dark:bg-indigo-900 dark:text-indigo-300">{{ $article->category->name }}</a>
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
            @endif
        </div>
    </div>

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#filterSubmit").click(function(e) {
                    e.preventDefault()
                    const text = $("#search-query").val();
                    const regex = /title:(.*?)\sbody:(.*)/;

                    // menambahkan logika tambahan untuk menangani kasus-kasus yang tidak memiliki "title" dan "body"
                    let extractedText = text.match(regex);
                    if (extractedText) {
                        extractedText = extractedText[0];
                    } else {
                        extractedText = "";
                    }

                    $("#search-query").val(extractedText);

                    setTimeout(() => {
                        $('#search-submit').click()
                    }, 700);
                });
            });
        </script>
    </x-slot>
</x-app-layout>
