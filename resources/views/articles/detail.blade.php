<x-app-layout>
   <x-slot name="header">
      @auth
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ auth()->user()->name == $article->user->name ? __('My Article') : __('Article') }}</h2>
      @else
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{  __('Article') }}</h2>
      @endauth
   </x-slot>

   <div class="py-12">
      <div class="max-w-7xl mx-auto px-2.5 sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
               <h1 class="font-bold text-3xl">{{ $article->title }}</h1>
               <div>
                  <h3 class="text-gray-500/90 text-sm">
                      By {{ $article->user->name }}
                  </h3>
                  <h3 class="text-gray-500/90 text-xs">
                      Published at {{ $article->created_at }}
                  </h3>
              </div>

              <div>
                  <p class="text-slate-800 font-barlow text-base mt-4">
                     {{ $article->body }}
                  </p>
              </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>