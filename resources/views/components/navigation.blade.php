<nav x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/dashboard">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                
                <!-- Navigation Items (Left Aligned) -->
                @auth
                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <x-nav-link href="/dashboard" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <x-nav-link href="/nodes" :active="request()->routeIs('nodes')">
                            {{ __('Nodes') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <x-nav-link href="/billing" :active="request()->routeIs('billing')">
                            {{ __('Billing') }}
                        </x-nav-link>
                    </div>
                
                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <x-nav-link href="/support" :active="request()->routeIs('support')">
                            {{ __('Support') }}
                        </x-nav-link>
                    </div>
                @else
                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <x-nav-link href="/product" :active="request()->routeIs('product')">
                            {{ __('Product') }}
                        </x-nav-link>
                    </div>
    
                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <x-nav-link href="/pricing" :active="request()->routeIs('pricing')">
                            {{ __('Pricing') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <x-nav-link href="/documentation" :active="request()->routeIs('documentation')">
                            {{ __('Documentation') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            @auth
                <div class="hidden sm:flex justify-self-end">
                    <!-- Navigation Items (Right Aligned) -->

                    <!-- Settings Dropdown -->
                    <div class="sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="/user/profile">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="/teams/{{ Auth::user()->currentTeam->id }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="/teams/create">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <xswitchable-team :team="$team" />
                                    @endforeach

                                    <div class="border-t border-gray-100"></div>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                 this.closest('form').submit();">
                                        {{ __('Logout') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            @else
                <div class="hidden sm:flex justify-self-end">
                    <div class="hidden sm:flex">
                        <x-nav-link href="/login" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 py-2.5 sm:ml-8 sm:flex">
                        <x-nav-button href="/register" :active="request()->routeIs('register')">
                            {{ __('Get Started') }}
                        </x-nav-button>
                    </div>
                </div>
            @endif

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->

    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="/dashboard" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="/nodes" :active="request()->routeIs('nodes')">
                    {{ __('Nodes') }}
                </x-responsive-nav-link>
            </div>
            
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="/billing" :active="request()->routeIs('billing')">
                    {{ __('Billing') }}
                </x-responsive-nav-link>
            </div>

            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="/support" :active="request()->routeIs('support')">
                    {{ __('Support') }}
                </x-responsive-nav-link>
            </div>
        @else 
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="/product" :active="request()->routeIs('product')">
                    {{ __('Product') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="/pricing" :active="request()->routeIs('pricing')">
                    {{ __('Pricing') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="/documentation" :active="request()->routeIs('documentation')">
                    {{ __('Documentation') }}
                </x-responsive-nav-link>
            </div>
        @endif

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="/user/api-tokens" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="/teams/{{ Auth::user()->currentTeam->id }}" :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link href="/teams/create" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="jet-responsive-nav-link" />
                        @endforeach
                    @endif
                </div>
            @else
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="/login" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link href="/register" :active="request()->routeIs('register')">
                        {{ __('Get Started') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>
    </div>

    {{ $slot }}
</nav>