<x-app-layout>
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
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="mb-3 mt-5">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="body" :value="__('Body')" />
                            <textarea id="body"
                                class="mt-1 h-28 w-full rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="body" value="{{ old('body') }}" required></textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>

                        <button type="submit"
                            class="inline-flex items-center rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white ring-gray-300 transition duration-150 ease-in-out hover:bg-blue-700 focus:border-gray-900 focus:outline-none focus:ring disabled:opacity-25">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
