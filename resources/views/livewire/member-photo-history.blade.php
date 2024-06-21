<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Photo History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ url()->previous() }}" wire:navigate class="btn-secondary mb-3">Kembali</a>
                    <h4 class="font-semibold mb-6">
                        Histori Foto Profil {{ $member->name }}
                    </h4>

                    <ol class="relative border-s border-gray-200 dark:border-gray-700">
                        <li class="mb-10 ms-4">
                            <div
                                class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                            </div>
                            <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Foto
                                Profil Saat Ini</time>
                            @php
                                setlocale(LC_TIME, 'IN');
                            @endphp
                            <img src="{{ Storage::url($member->photo) }}" alt="Foto Profil Saat ini"
                                class="w-32 rounded-lg"
                                x-on:click="Swal.fire({
                        imageUrl: $el.src,
                        title: $el.getAttribute('alt')
                    })">
                        </li>
                        @foreach ($photo_histories as $history)
                            <li class="mb-10 ms-4">
                                <div
                                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                                </div>
                                <time
                                    class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $history->created_at->diffForHumans() }}</time>
                                @php
                                    setlocale(LC_TIME, 'IN');
                                @endphp
                                <img src="{{ Storage::url($history->photo) }}"
                                    alt="{{ date_format($history->created_at, 'D d F Y H:i:s') }}"
                                    class="w-32 rounded-lg"
                                    x-on:click="Swal.fire({
                        imageUrl: $el.src,
                        title: $el.getAttribute('alt')
                    })">
                            </li>
                        @endforeach
                    </ol>



                </div>
            </div>
        </div>
    </div>
</div>
