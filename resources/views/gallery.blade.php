<x-main-layout>
    <x-slot name="header">
        @livewire('HeroSection', ['height' => '30', 'text' => 'Galeri Foto'])
    </x-slot>

    <x-slot name="title">Galeri Foto</x-slot>

    <div class="columns-2 md:columns-4">
        @livewire('GalleryItem', ['url' => '/images/pura1.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura2.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura3.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura4.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura5.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura6.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura7.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura8.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura9.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura10.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura11.jpg'])
        @livewire('GalleryItem', ['url' => '/images/pura12.jpg'])

    </div>


</x-main-layout>
