<?php

namespace App\Livewire;

use Livewire\Component;

class GalleryCTA extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div class="flex justify-between flex-col md:flex-row">
            <div class="flex md:w-1/2 justify-center items-center md:p-16">
                <div class="hidden md:block">
                    <img src="/images/pura2.jpg" alt="Pura" class="w-full hover:saturate-150 transition rounded-xl md:rounded-none hidden md:block">
                </div>
                <div class="block md:hidden">
                    @livewire('RecentActivity')
                </div>
            </div>
            <div class="flex w-full md:max-w-[50vw] bg-yellow-300/20 dark:bg-yellow-900/50">

                <div class="flex flex-col gap-4 justify-center p-8 md:px-16">
                    <div class="w-24 h-3 bg-yellow-900 dark:bg-yellow-700"></div>
                    <div>
                        <h2 class="text-2xl md:text-3xl">Galeri Foto</h2>
                    </div>
                    <div>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt itaque omnis sed optio voluptate
                        harum quod mollitia doloremque aliquam nostrum eveniet, excepturi veniam vel quos deleniti fugit
                        repudiandae deserunt iste?
                    </div>
                    <a class="px-6 py-3 border-yellow-900 dark:border-yellow-700 border-2 hover:bg-yellow-900 transition text-yellow-900 dark:text-yellow-700 hover:text-white font-bold text-center"
                        href="{{ Route::has('gallery') ? route('gallery') : '#' }}">
                        Lihat Galeri
                    </a>
                </div>

            </div>
        </div>
        HTML;
    }
}
