<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('About Me') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-2.5 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <p>{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
