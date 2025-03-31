<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome to Our Website') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Sección Hero -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-10 text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    {{ __('Discover Amazing Features') }}
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                    {{ __('Join our community and explore everything we have to offer.') }}
                </p>
                <a href="#" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
                    {{ __('Get Started') }}
                </a>
            </div>

            <!-- Sección de Características -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Feature 1') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Brief description of this feature.') }}</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Feature 2') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Brief description of this feature.') }}</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Feature 3') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Brief description of this feature.') }}</p>
                </div>
            </div>
        </div>
    </div>
    @dump($GLOBALS)
</x-app-layout>
