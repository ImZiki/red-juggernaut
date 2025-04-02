<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black  leading-tight">
            {{ __('Perfil de usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Sección de bienvenida -->
            <div class=" overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-black">
                    {{ __('Hello, '. \Illuminate\Support\Facades\Auth::user()['name']) }}
                </h3>
                <p class="mt-1 text-sm text-black">
                    {{ __("Bienvenido a tu perfil de usuario") }}
                </p>
            </div>

            <!-- Sección de acceso rápido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 ">
                <a href="{{route('profile.edit')}}" class="p-6  shadow sm:rounded-lg text-center hover:bg-gray-100  text-white hover:text-black bg-black transition">
                    <h3 class="text-lg font-semibold ">{{ __('Editar') }}</h3>
                    <p class="text-sm ">{{ __('Cambia tus datos') }}</p>
                </a>

                <a href="{{route('profile.orderhistory')}}" class="p-6  shadow sm:rounded-lg text-center hover:bg-gray-100 text-white hover:text-black bg-black transition">
                    <h3 class="text-lg font-semibold ">{{ __('Pedidos') }}</h3>
                    <p class="text-sm ">{{ __('Revisa tu historial de compras') }}</p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
