<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="data()" :class="{ 'dark': dark }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            .swal2-styled.swal2-confirm {
                background-color: #3f83f8 !important;
            }

            [x-cloak] {
                display: none;
            }

        </style>
        <template x-if="dark">
            <style>
                .swal2-popup {
                    background: #24262d !important;
                }

                .swal2-title {
                    color: #e5e7eb !important;
                }

                .swal2-input {
                    border: 2px solid #4c4f52 !important;
                    color: #e5e7eb !important;
                }

                .swal2-content {
                    color: #d5d6d7 !important;
                }

                .swal2-html-container {
                    color: #e5e7eb !important;
                }

                .swal2-validation-message {
                    background: #1a1c23 !important;
                    color: #e5e7eb !important;
                }

            </style>
        </template>

        {{ $styles ?? '' }}
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @livewireStyles
        @livewireScripts
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
        <script src="https://unpkg.com/flowbite@1.4.1/dist/datepicker.js"></script>


    </head>

    <body class="dark:bg-gray-900">
        @livewire('alert')
        <x-nav.navigation>
            <h2 class="ml-6 mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $header ?? '' }}
            </h2>
            {{ $slot }}
        </x-nav.navigation>
        @yield('scripts')
    </body>
</html>
