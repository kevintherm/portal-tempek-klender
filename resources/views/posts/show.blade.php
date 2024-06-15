<x-main-layout>

    <x-slot name="title">{{ $post->title }}</x-slot>

    <x-slot name="header">
        @livewire('HeroSection', ['text' => ucwords($post->type->value), 'height' => 30])
    </x-slot>


    <div class="flex gap-4 justify-center flex-col items-center">

        <a href="{{ route('posts.index') }}"
            class="border-b border-gray-500 hover:border-yellow-600 hover:text-yellow-700 hover:shadow-xl transition-all ">Kembali</a>
        @livewire('AuthorInfo', ['author' => $post->author, 'post_created_at' => $post->created_at])

        <article class="prose py-6 dark:prose-invert">
            <h3 class="text-center">{{ $post->title }}</h3>
            <br>
            {!! $post->body !!}
        </article>
    </div>

</x-main-layout>
