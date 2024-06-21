    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Pengurus') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <a href="{{ url()->previous() }}" wire:navigate class="btn-secondary mb-3">Kembali</a>
                        <h4 class="font-semibold mb-6">
                            Riwayat Pengurus
                        </h4>

                        @foreach ($roles as $role)
                            @continue($role->name === 'Anggota')
                            <h4 class="font-semibold mb-6">
                                {{ $role->name }}
                            </h4>
                            <ol class="relative border-s border-gray-200 dark:border-gray-700">
                                <li class="mb-10 ms-4">
                                    <div
                                        class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                                    </div>
                                    <time
                                        class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                        {{ $role->name }} Saat Ini
                                    </time>
                                    <ul class="list-disc ps-4">
                                        @foreach ($role->users as $user)
                                            <li>{{ $user->name }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                @foreach (\App\Models\StaffHistory::where('role_id', $role->id)->get() as $history)
                                    <li class="mb-10 ms-4">
                                        <div
                                            class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                                        </div>
                                        <time
                                            class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $history->created_at->format('d F Y') }}</time>
                                        <p>{{ $history->member->name }}</p>
                                        {{--
                                        <img src="" alt="" class="w-32 rounded-lg"
                                            x-on:click="Swal.fire({
                                imageUrl: $el.src,
                                title: $el.getAttribute('alt')
                            })"> --}}
                                    </li>
                                @endforeach
                            </ol>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
