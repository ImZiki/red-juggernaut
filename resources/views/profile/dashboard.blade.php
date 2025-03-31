<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil de usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Sección de bienvenida -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ __('Hello, ') }}
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Bienvenido a tu panel de control") }}
                </p>
            </div>

            <!-- Sección de acceso rápido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{route('profile.edit')}}" class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Editar') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Cambia tus datos') }}</p>
                </a>

                <a href="#" class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Pedidos') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Revisa tu historial de compras') }}</p>
                </a>

            </div>


        </div>
    </div>
</x-app-layout>
