<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{  __('All Article') }}</h2>
   </x-slot>

   <div class="py-12">
      <div class="max-w-7xl mx-auto px-2.5 sm:px-6 lg:px-8">
         <div class="grid justify-center md:justify-start lg:grid-cols-3 md:grid-cols-2 gap-x-4 gap-y-7">
            @foreach ($articles as $article)
            <div class="p-6 max-w-lg bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 self-stretch flex flex-wrap flex-col items-start justify-between">
               <a href="articles/{{ $article->slug }}"><h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->title }}</h1></a>
               <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm sm:text-base">{{ $article->body }}</p>
               <div class="flex justify-between w-full items-center">
                  <h5 class="text-xs sm:text-sm tracking-tight text-gray-500 dark:text-white">By {{ $article->user->name }}</h5>
                  <a
                     href="articles/{{ $article->slug }}"
                     class="inline-flex items-center py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                     >Read More 
                     <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fillRule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clipRule="evenodd"></path>
                     </svg>                     
                  </a>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</x-app-layout>
