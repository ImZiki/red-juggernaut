<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Perfil de usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Sección de bienvenida -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-black">
                    {{ __('Hello, ' . Auth::user()->name) }}
                </h3>
                <p class="mt-1 text-sm text-black">
                    {{ __("Bienvenido a tu perfil de usuario") }}
                </p>
            </div>

            <!-- Información del usuario -->
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h4 class="text-md font-semibold text-black mb-2">{{ __('Datos del usuario') }}</h4>
                <p class="text-sm text-black"><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                <p class="text-sm text-black"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p class="text-sm text-black flex items-center gap-2">
                    <strong>Verificación de email:</strong>
                    @if (Auth::user()->hasVerifiedEmail())
                        <span class="text-green-600 font-semibold">Verificado ✅</span>
                    @else
                        <span class="text-red-600 font-semibold">No verificado ❌</span>
                    @endif
                </p>

                @if (! Auth::user()->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded">
                        <p class="text-sm">Tu dirección de correo electrónico no está verificada.</p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <x-primary-button class="mt-2">
                                {{ __('Reenviar correo de verificación') }}
                            </x-primary-button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Sección de acceso rápido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('profile.edit') }}" class="p-6 shadow sm:rounded-lg text-center hover:bg-gray-100 text-white hover:text-black bg-black transition">
                    <h3 class="text-lg font-semibold">{{ __('Editar') }}</h3>
                    <p class="text-sm">{{ __('Cambia tus datos') }}</p>
                </a>

                <a href="{{ route('profile.orderhistory') }}" class="p-6 shadow sm:rounded-lg text-center hover:bg-gray-100 text-white hover:text-black bg-black transition">
                    <h3 class="text-lg font-semibold">{{ __('Pedidos') }}</h3>
                    <p class="text-sm">{{ __('Revisa tu historial de compras') }}</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
