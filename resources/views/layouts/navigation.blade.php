<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                @auth
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('about_me')" :active="request()->routeIs('about_me')">
                            {{ __('About Me') }}
                        </x-nav-link>
                    </div>
                @endauth

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if ($articleId && !empty(auth()->user()))
                        <x-nav-link :href="route('articles.all_articles')" :active="$articleId != auth()->user()->id &&
                            request()->routeIs(['articles.all_articles', 'articles.show'])">
                            {{ __('Article') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('articles.all_articles')" :active="request()->routeIs(['articles.all_articles', 'articles.show'])">
                            {{ __('Article') }}
                        </x-nav-link>
                    @endif
                </div>

                @auth
                    <!-- Navigation Links -->
                    @if (!auth()->user()->hasRole('Super Admin'))
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('articles.index')" :active="($articleId ? $articleId == auth()->user()->id : false) ||
                                request()->routeIs(['articles.index', 'articles.create', 'articles.edit'])">
                                {{ __('My Article') }}
                            </x-nav-link>
                        </div>
                    @endif

                    @can('category_access')
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('category.index')" :active="request()->routeIs(['category.index', 'category.create', 'category.edit'])">
                                {{ __('Category') }}
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('tag_access')
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('tag.index')" :active="request()->routeIs(['tag.index', 'tag.create', 'tag.edit'])">
                                {{ __('Tag') }}
                            </x-nav-link>
                        </div>
                    @endcan
                @endauth
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div>
                        <a href="{{ route('login') }}"
                            class="text-sm text-gray-700 hover:text-gray-500 hover:underline dark:text-gray-500 hover:dark:text-gray-600">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 hover:text-gray-500 hover:underline dark:text-gray-500 hover:dark:text-gray-600">Register</a>
                        @endif
                    </div>
                @endauth
            </div>



            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @auth
            <div class="space-y-1 pt-2 pb-3">
                <x-responsive-nav-link :href="route('about_me')" :active="request()->routeIs('about_me')">
                    {{ __('About Me') }}
                </x-responsive-nav-link>
            </div>
        @endauth

        <div class="space-y-1 pt-2 pb-3">
            @if ($articleId && !empty(auth()->user()))
                <x-responsive-nav-link :href="route('articles.all_articles')" :active="$articleId != auth()->user()->id &&
                    request()->routeIs(['articles.all_articles', 'articles.show'])">
                    {{ __('Article') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('articles.all_articles')" :active="request()->routeIs(['articles.all_articles', 'articles.show'])">
                    {{ __('Article') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @auth
            <div class="space-y-1 pt-2 pb-3">
                <x-responsive-nav-link :href="route('articles.index')" :active="($articleId ? $articleId == auth()->user()->id : false) ||
                    request()->routeIs(['articles.index', 'articles.create', 'articles.edit'])">
                    {{ __('My Article') }}
                </x-responsive-nav-link>
            </div>

            <div class="space-y-1 pt-2 pb-3">
                <x-responsive-nav-link :href="route('category.index')" :active="request()->routeIs(['category.index', 'category.create', 'category.edit'])">
                    {{ __('Category') }}
                </x-responsive-nav-link>
            </div>

            <div class="space-y-1 pt-2 pb-3">
                <x-responsive-nav-link :href="route('tag.index')" :active="request()->routeIs(['tag.index', 'tag.create', 'tag.edit'])">
                    {{ __('Tag') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="border-t border-gray-200 pt-4 pb-1 dark:border-gray-600">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
