<nav x-data="{ open: false }" class="">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{asset('images/logo.png')}}" alt="Logo" class="h-20 w-20">
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(request()->is('admin*'))
                        {{-- Menú para /admin --}}
                        <x-nav-link :href="url('/admin')" :active="request()->is('admin')" class="text-black">
                            {{ __('Panel Inicio') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/concerts')" :active="request()->is('admin/concerts')" class="text-black">
                            {{ __('Gestionar conciertos') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/products')" :active="request()->is('admin/products')" class="text-black">
                            {{ __('Gestionar productos') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/orders')" :active="request()->is('admin/orders')" class="text-black">
                            {{ __('Gestionar pedidos') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/posts')" :active="request()->is('admin/posts')" class="text-black">
                            {{ __('Gestionar posts') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/')" class="text-black">
                            {{ __('Salir del Panel') }}
                        </x-nav-link>
                    @else
                        {{-- Menú para el resto de la web --}}
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-black">
                            {{ __('Inicio') }}
                        </x-nav-link>
                        <x-nav-link :href="route('racf')" :active="request()->routeIs('racf')" class="text-black">
                            {{ __('R.A.C.F') }}
                        </x-nav-link>
                        <x-nav-link :href="route('ops')" :active="request()->routeIs('ops')" class="text-black">
                            {{ __('Operaciones') }}
                        </x-nav-link>
                        <x-nav-link :href="route('comms')" :active="request()->routeIs('comms')" class="text-black">
                            {{ __('Comms') }}
                        </x-nav-link>
                        <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')" class="text-black">
                            {{ __('Tienda') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-8">
                @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.dashboard')" class="text-black">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @if(in_array(Auth::user()->role, ['admin', 'superadmin']))
                                <x-dropdown-link :href="route('admin.index')" class="text-black">
                                    {{ __('Panel de Administracion') }}
                                </x-dropdown-link>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();" class="text-black">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-black">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-black">
                        {{ __('Register') }}
                    </x-nav-link>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(request()->is('admin*'))
                {{-- Menú responsive para /admin --}}
                <x-responsive-nav-link :href="url('/admin')" :active="request()->is('admin')" class="text-black">
                    {{ __('Panel Inicio') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/admin/concerts')" :active="request()->is('admin/concerts')" class="text-black">
                    {{ __('Gestionar conciertos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/admin/products')" :active="request()->is('admin/products')" class="text-black">
                    {{ __('Gestionar productos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/admin/orders')" :active="request()->is('admin/orders')" class="text-black">
                    {{ __('Gestionar pedidos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/admin/posts')" :active="request()->is('admin/orders')" class="text-black">
                    {{ __('Gestionar posts') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/')" class="text-black">
                    {{ __('Salir del Panel') }}
                </x-responsive-nav-link>
            @else
                {{-- Menú responsive para el resto de la web --}}
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-black">
                    {{ __('Inicio') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('racf')" :active="request()->routeIs('racf')" class="text-black">
                    {{ __('R.A.C.F.') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('ops')" :active="request()->routeIs('ops')" class="text-black">
                    {{ __('Operaciones') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('comms')" :active="request()->routeIs('comms')" class="text-black">
                    {{ __('Comms') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')" class="text-black">
                    {{ __('Tienda') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Auth::check())
                <div class="px-4">
                    <div class="font-medium text-base text-black">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-black">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.dashboard')" class="text-black">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    @if(in_array(Auth::user()->role, ['admin', 'superadmin']))
                        <x-responsive-nav-link :href="route('admin.index')" class="text-black">
                            {{ __('Panel de Administracion') }}
                        </x-responsive-nav-link>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();" class="text-black">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-black">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-black">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>
