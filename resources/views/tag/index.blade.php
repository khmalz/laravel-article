<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-2.5 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-5 flex items-center justify-end gap-4">
                        <a href="{{ route('tag.create') }}">
                            <x-primary-button>{{ __('Add New Tag') }}</x-primary-button>
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md">
                        <table class="w-full border border-gray-200 text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead
                                class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="rounded-l-lg px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="rounded-r-lg px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th scope="row"
                                            class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white md:pr-44">
                                            {{ $tag->name }}
                                        </th>
                                        <td class="px-6 py-4 text-gray-900">
                                            <div class="flex gap-x-1.5">
                                                <a href="{{ route('tag.edit', $tag->slug) }}">
                                                    <x-primary-button class="px-3">{{ __('Edit') }}
                                                    </x-primary-button>
                                                </a>
                                                <x-primary-button class="px-3">{{ __('Delete') }}
                                                </x-primary-button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th scope="row"
                                            class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white md:pr-44">
                                            Data Not Found
                                        </th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
