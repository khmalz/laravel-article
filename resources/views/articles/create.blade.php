<x-app-layout>
    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('Create Article') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl px-2.5 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6">
                    <h1 class="text-center text-2xl font-bold">
                        Create Article
                    </h1>

                    <form action="{{ route('articles.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="mb-3 mt-5">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="title" :value="old('title')" autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="body" :value="__('Body')" />
                            <textarea id="body"
                                class="mt-1 h-28 w-full rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="body">{{ old('body') }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category" :value="__('Category')" />
                            <x-select name="category_id" class="mt-1">
                                <option {{ !old('category_id') ? 'selected' : '' }} disabled value="">Choose a
                                    category</option>
                                @foreach ($categories as $category)
                                    @if (old('category_id') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="tags" :value="__('Tag')" />
                            <x-select name="tags[]" class="multiple mt-1" multiple>
                                @foreach ($tags as $tag)
                                    @if (old('tags') == $tag->id)
                                        <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                    @else
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endif
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                        </div>

                        <button type="submit"
                            class="inline-flex items-center rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white ring-gray-300 transition duration-150 ease-in-out hover:bg-blue-700 focus:border-gray-900 focus:outline-none focus:ring disabled:opacity-25">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.multiple').select2();
            });
        </script>
    </x-slot>
</x-app-layout>
