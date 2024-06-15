<?php

namespace App\Livewire;

use Livewire\Component;

class HeroSection extends Component
{
    public $height = 65;
    public $text;

    public function render()
    {
        return <<<'HTML'
            <div style="min-height: {{$this->height}}vh; background-image: url('/images/pura1.jpg')" class="overflow-hidden bg-cover bg-gray-800 relative shadow">
            <div class="absolute inset-0 ">
                <div class="w-full h-full bg-yellow-800/30 absolute ">
                    <header class="py-5 px-4 md:px-12 absolute left-0 top-0 right-0">
                        <div class="w-full flex justify-between">
                            <h1 class="text-lg md:text-2xl text-center font-semibold tracking-wider text-white">
                                <a href="/">
                                    Tempek Klender
                                </a>
                            </h1>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @if(Route::has('dashboard'))
                                        <x-dropdown-link :href="route('dashboard')" wire:navigate>
                                            {{ __('Dashboard') }}
                                        </x-dropdown-link>
                                    @endif
                                    @livewire('DarkModeSelector')
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </header>


                    <div class="flex flex-col justify-center items-center py-12 h-full">
                        @if(!$this->text)
                            <h1 class="text-xl md:text-5xl text-white font-semibold">Selamat Datang</h1>
                            <h4 class="text-xl text-white font-semibold">di</h4>
                            <h2 class="text-xl md:text-5xl text-white font-semibold">Web Portal Tempek Klender</h2>
                        @else
                            <h1 class="text-xl md:text-5xl text-white font-semibold">{{$this->text}}</h1>
                        @endif
                    </div>

                    <div
                        class="absolute bottom-0 left-0 right-0 flex justify-between items-center text-white py-4 md:py-12 px-4 md:px-12">
                        <a href="{{route('posts.index', ['type'=>'kegiatan'])}}"
                            class="border-b-2 border-white font-semibold text-sm hover:border-yellow-500 animate duration-300">
                            Kegiatan
                        </a>
                        <a href="{{route('posts.index')}}"
                            class="border-b-2 border-white font-semibold text-sm hover:border-yellow-500 animate duration-300">
                            Postingan
                        </a>
                        <a href="{{route('about')}}"
                            class="border-b-2 border-white font-semibold text-sm hover:border-yellow-500 animate duration-300">
                            Tentang Kami
                        </a>
                    </div>

                </div>
            </div>
        </div>
        HTML;
    }
}
