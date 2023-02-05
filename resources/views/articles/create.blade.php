<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{  __('Create Article') }}</h2>
   </x-slot>

   <div class="py-12">
      <div class="max-w-3xl mx-auto px-2.5 sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
               <h1 class="text-2xl font-bold text-center">
                  Create Article
              </h1>

               <form action="{{ route('articles.store') }}" method="post">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                  
                  <div class="mb-3 mt-5">
                     <x-input-label for="title" :value="__('Title')" />
                     <x-text-input id="title" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                     <x-input-error :messages="$errors->get('title')" class="mt-2" />
                 </div>

                  <div class="mb-3">
                     <x-input-label for="body" :value="__('Body')" />
                     <textarea id="body" class="w-full h-28 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg mt-1" name="body" value="{{ old('body') }}" required></textarea>
                     <x-input-error :messages="$errors->get('body')" class="mt-2" />
                 </div>

                 <button type="submit" class="bg-blue-600 hover:bg-blue-700 rounded-lg inline-flex items-center px-4 py-2 border border-transparent font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>
