<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset("storage/image/HMI_logo.png") }}" alt="logo HMI" class="block h-12 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @can('isAdmin')
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endcan

                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Diễn Đàn') }}
                    </x-nav-link>

                    <!-- Management Dropdown for Admin -->
                    @can('isAdmin')
                        <div class="relative flex" x-data="{ open: false }" @click.away="open = false">
                            <!-- Dropdown Trigger -->
                            <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none
                                @if(request()->routeIs('adminstudent', 'admin.reports.index', 'admin.manage.schedules', 'admin.tasks.*'))
                                    border-indigo-400 text-gray-900 focus:border-indigo-700
                                @else
                                    border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300
                                @endif">
                                <div>Quản lý</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </button>

                            <!-- Dropdown Content -->
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute z-50 mt-16 w-60 rounded-md shadow-lg" style="display: none;" @click="open = false">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <x-dropdown-link :href="route('adminstudent')">{{ __('Sinh viên') }}</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.reports.index')">{{ __('Quản lý Báo Cáo') }}</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.manage.schedules')">{{ __('Quản lý Lịch lên Lab') }}</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.tasks.index')">{{ __('Quản lý Task') }}</x-dropdown-link>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Show 'Sinh vien' for non-admins to keep original behavior -->
                        <x-nav-link :href="route('adminstudent')" :active="request()->routeIs('adminstudent')">
                            {{ __('Sinh viên') }}
                        </x-nav-link>
                    @endcan

                    <!-- Student Links -->
                    @can('isStudent')
                        <x-nav-link href="{{ route('student.reports') }}" :active="request()->routeIs('student.reports')">
                            {{ __('Nộp Báo Cáo') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('student.tasks.index') }}" :active="request()->routeIs('student.tasks.*')">
                            {{ __('Task của tôi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('lab.schedule.index')" :active="request()->routeIs('lab.schedule.index')">
                            {{ __('Lịch Lên Lab') }}
                        </x-nav-link>
                    @endcan

                    <x-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.index')">
                        {{ __('Tài liệu Lab') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}
                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <div class="ms-3 relative">
                    @livewire('notification-bell')
                </div>

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}
                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>
                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif
                            <div class="border-t border-gray-200"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @can('isAdmin')
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endcan

            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Diễn Đàn') }}
            </x-responsive-nav-link>

            <!-- Management Links for Admin -->
            @can('isAdmin')
                <div class="pt-2 pb-1 border-t border-gray-200">
                    <div class="block px-4 pt-2 text-xs text-gray-400">
                        {{ __('Quản lý') }}
                    </div>
                    <x-responsive-nav-link :href="route('adminstudent')" :active="request()->routeIs('adminstudent')">
                        {{ __('Sinh viên') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.index')">
                        {{ __('Quản lý Báo Cáo') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.manage.schedules')" :active="request()->routeIs('admin.manage.schedules')">
                        {{ __('Quản lý Lịch lên Lab') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.tasks.index')" :active="request()->routeIs('admin.tasks.*')">
                        {{ __('Quản lý Task') }}
                    </x-responsive-nav-link>
                </div>
            @else
                <x-responsive-nav-link :href="route('adminstudent')" :active="request()->routeIs('adminstudent')">
                    {{ __('Sinh viên') }}
                </x-responsive-nav-link>
            @endcan

            <!-- Student Links -->
            @can('isStudent')
                <x-responsive-nav-link href="{{ route('student.reports') }}" :active="request()->routeIs('student.reports')">
                    {{ __('Nộp Báo Cáo') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('student.tasks.index') }}" :active="request()->routeIs('student.tasks.*')">
                    {{ __('Task của tôi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('lab.schedule.index')" :active="request()->routeIs('lab.schedule.index')">
                    {{ __('Lịch Lên Lab') }}
                </x-responsive-nav-link>
            @endcan


            <x-responsive-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.index')">
                {{ __('Tài liệu Lab') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>
                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan
                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>
                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
