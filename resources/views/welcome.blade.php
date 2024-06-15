<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="darkmode" x-bind="apply">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tempek Klender - Rawamangun</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- FavIcon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/favico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favico/favicon-16x16.png">
    <link rel="manifest" href="/favico/site.webmanifest">

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
</head>

<body class="antialiased font-sans ">

    <div class="bg-gray-50 text-black/80 dark:bg-gray-800 dark:text-white/80 ">

        @livewire('HeroSection')

        @livewire('GalleryCTA')

        <div>
            <img src="/images/pura3.jpg" alt="Pura" class="h-screen w-screen object-cover">
        </div>

        <div class="md:block hidden">
            @livewire('RecentActivity')
        </div>

        <section class="flex items-center flex-col py-28">
            <p class="font-bold mb-2">
                Ketua & Pengurus
            </p>
            <h4 class="text-2xl text-center">
                Ketua dan Pengurus dari Tempek Klender
            </h4>
            <div class="flex flex-wrap px-8 md:px-16 gap-x-[7rem] gap-y-8 my-12 justify-evenly">
                @foreach (range(0, 6) as $num)
                    <div class="flex flex-col items-center gap-2">
                        <img src="https://static-00.iconduck.com/assets.00/avatar-default-symbolic-icon-479x512-n8sg74wg.png"
                            alt="person" class="w-32 aspect-square rounded-full">
                        <p class="font-semibold text-black dark:text-white">Nama Person</p>
                        <p class="font-bold text-yellow-700/70 dark:text-yellow-700">Jabatan Personal</p>
                        <div class="w-full flex gap-4 items-center justify-evenly">
                            <a href="#"
                                class="hover:bg-yellow-700/10 py-3 px-4 transition duration-300 rounded-xl">
                                <i class="fa-brands fa-facebook fa-lg"></i>
                            </a>
                            <a href="#"
                                class="hover:bg-yellow-700/10 py-3 px-4 transition duration-300 rounded-xl">
                                <i class="fa-brands fa-instagram fa-lg"></i>
                            </a>
                            <a href="#"
                                class="hover:bg-yellow-700/10 py-3 px-4 transition duration-300 rounded-xl">
                                <i class="fa-brands fa-whatsapp fa-lg"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        @livewire('Footer')
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
    </div>
</body>

</html>
