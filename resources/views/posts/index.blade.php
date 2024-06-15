<x-main-layout>
    <x-slot name="header">
        @livewire('HeroSection', ['text' => ucwords(request('type', 'Postingan')), 'height' => 30])
    </x-slot>

    <x-slot name="title">{{ ucwords(request('type', 'Postingan')) }}</x-slot>

    <section class="flex flex-col items-center gap-16 justify-center py-12 px-4">

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center gap-2">
                    <h3 class="text-xl font-semibold dark:text-gray-50">
                        {{ ucwords(request('type', 'Postingan')) }}
                        Terbaru</h3>

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('posts.index')" wire:navigate>
                    {{ __('Semua Jenis Postingan') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('posts.index', ['type' => 'post'])" wire:navigate>
                    {{ __('Postingan Biasa') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('posts.index', ['type' => 'kegiatan'])" wire:navigate>
                    {{ __('Kegiatan') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('posts.index', ['type' => 'pengumuman'])" wire:navigate>
                    {{ __('Pengumuman') }}
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>

        <section>
            <ol class="relative border-s border-yellow-700/20 dark:border-yellow-700 max-w-xl">

                @forelse ($posts as $post)
                    <li class="ms-6 py-4">
                        <a href="{{ route('posts.index', ['type' => $post->type]) }}">
                            <span
                                class="absolute flex items-center justify-center w-6 h-6 bg-orange-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 ">
                                @switch($post->type)
                                    @case('post')
                                        <i class="fa-regular fa-newspaper fa-sm text-gray-700 dark:text-gray-900"></i>
                                    @break

                                    @case('kegiatan')
                                        <i class="fa-solid fa-calendar-days fa-sm text-gray-700 dark:text-gray-900"></i>
                                    @break

                                    @case('pengumuman')
                                        <i class="fa-solid fa-bullhorn fa-sm text-gray-700 dark:text-gray-900"></i>
                                    @break
                                @endswitch
                            </span>
                        </a>
                        <h3 class="mb-1 md:text-lg font-semibold text-gray-900 dark:text-white line-clamp-1">
                            <a
                                href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 35, '...') }}</a>
                        </h3>
                        <time
                            class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Released
                            on
                            {{ $post->created_at->format('d M Y') }}</time>
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400 line-clamp-1">
                                {{ Str::limit(strip_tags($post->body), 35) }}
                            </p>
                        </a>
                    </li>

                    @empty
                        <p>Tidak ada postingan lagi.</p>
                    @endforelse
                </ol>

                {{ $posts->links('pagination::simple-tailwind') }}


            </section>



    </x-main-layout>
