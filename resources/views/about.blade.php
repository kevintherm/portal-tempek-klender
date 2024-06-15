<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tentang Tempek Klender - Rawamangun</title>

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
</head>

<body class="antialiased font-sans ">

    <div class="bg-gray-50 text-black/80 dark:bg-gray-800 dark:text-white/80 ">

        @livewire('HeroSection', ['text' => 'Tentang Tempek Klender', 'height' => 30])

        <main class="min-h-screen px-4 md:px-12 py-6">

            <div class="flex justify-center">
                <article class="prose py-6 dark:prose-invert">
                    <h3>Tentang kami</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore officiis in officia,
                        reprehenderit
                        delectus tempora fugit suscipit quae voluptate maxime asperiores accusamus excepturi velit rerum
                        distinctio. Ut totam vel rem.</p>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero sapiente animi at. Error facere
                        laboriosam accusamus, vitae, et voluptas molestias laborum aperiam at iure autem amet harum
                        architecto vero soluta?</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quidem nam fugit tenetur odio
                        libero, ratione maxime a eum beatae similique? Reprehenderit minus minima sint nostrum quisquam
                        aliquid sed asperiores.</p>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero sapiente animi at. Error facere
                        laboriosam accusamus, vitae, et voluptas molestias laborum aperiam at iure autem amet harum
                        architecto vero soluta?</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quidem nam fugit tenetur odio
                        libero, ratione maxime a eum beatae similique? Reprehenderit minus minima sint nostrum quisquam
                        aliquid sed asperiores.</p>
                </article>
            </div>



        </main>

        @livewire('Footer')

    </div>
</body>

</html>
