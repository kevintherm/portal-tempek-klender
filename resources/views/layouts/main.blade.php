<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="darkmode"
    x-bind:class="{
        'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)')
            .matches)
    }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ isset($title) ? $title : config('app.name') }} - Rawamangun</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            /* Preferred icon size */
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;

            /* Support for all WebKit browsers. */
            -webkit-font-smoothing: antialiased;
            /* Support for Safari and Chrome. */
            text-rendering: optimizeLegibility;

            /* Support for Firefox. */
            -moz-osx-font-smoothing: grayscale;

            /* Support for IE. */
            font-feature-settings: 'liga';
        }
    </style>
    @if (isset($head))
        {{ $head }}
    @endif
</head>

<body class="antialiased font-sans ">

    <div class="bg-gray-50 text-black/80 dark:bg-gray-800 dark:text-white/80 ">

        @if (isset($header))
            {{ $header }}
        @endif

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <main class="min-h-screen px-4 md:px-12 py-6">

            {{ $slot }}

        </main>

        @livewire('Footer')

    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('darkmode', () => ({
                darkMode: localStorage.getItem('darkMode') ||
                    localStorage.setItem('darkMode', 'system'),
                init() {
                    this.$watch('darkMode', (val) => {
                        localStorage.setItem('darkMode', val)
                    })
                },
                trigger: {
                    ['x-on:click']() {
                        this.darkMode = this.darkMode == 'dark' ? 'light' : 'dark';
                        location.reload()
                    },
                },

                apply: {
                    ['x-bind:class']() {
                        return this.darkMode
                    },
                },
            }))
        })
    </script>
    @if (isset($foot))
        {{ $foot }}
    @endif
</body>

</html>
