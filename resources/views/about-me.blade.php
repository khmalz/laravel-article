<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('About Me') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2.5 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6">
                    <p>{{ auth()->user()->name }}</p>
                    <p class="text-slate-500 text-xs">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
