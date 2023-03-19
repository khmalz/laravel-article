<x-app-layout>
    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('Edit a Tag') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl px-2.5 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6">
                    <h1 class="text-center text-2xl font-bold">
                        Edit Tag
                    </h1>

                    <form action="{{ route('tag.update', $tag->slug) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3 mt-5">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="name" :value="old('name', $tag->name)" autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <x-primary-button>{{ __('Add Tag') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
