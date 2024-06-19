<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900 dark:text-gray-100">

        <x-modal name="perm-details" :show="$errors->isNotEmpty()">
            <div class="p-6">
                <div class="flex justify-between">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Lihat Detail Izin') }}
                    </h2>
                    <button x-on:click="$dispatch('close-modal', 'perm-details')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if ($selectedPerm)
                    <div>
                        <div class="mb-3">
                            <p class="text-lg font-semibold">
                                Izin
                            </p>
                            <p>
                                {{ $selectedPerm->name }}
                            </p>
                        </div>
                        <div class="mb-3">
                            <div class="text-lg font-semibold">
                                Jabatan Yang Memiliki Izin Ini:
                            </div>
                            <ul>
                                @foreach ($selectedPerm->roles as $role)
                                    <li>
                                        <p>{{ $role->name }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <p>Tidak ada jabatan yang dipilih.</p>
                @endif

            </div>
        </x-modal>

        <div class="flex justify-between mb-4 flex-wrap">
            <h3 class="text-lg font-semibold">Izin</h3>
            <a wire:navigate href="{{ route('perms.create') }}" class="btn-secondary">
                Tambah Izin
            </a>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jabatan
                        </th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $i => $permission)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 capitalize">
                                {{ $i + 1 }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white capitalize">
                                {{ $permission->name }}
                            </th>
                            <td class="px-6 py-4 flex gap-2 flex-wrap justify-center" x-data="{
                                deletePerm: (slug) => {
                                    Swal.fire({
                                        title: 'KONFIRMASI HAPUS',
                                        text: 'PERINGATAN! APAKAH ANDA YAKIN INGIN MENGHAPUS IZIN ?',
                                        confirmButtonText: 'Batal',
                                        showDenyButton: true,
                                        denyButtonText: 'HAPUS',
                                    }).then((result) => {
                                        if (result.isDenied) {
                                            $wire.call('delete_post', slug)
                                        }
                                    });
                                }
                            }">
                                <x-primary-button class="btn-primary"
                                    wire:click.prevent="show_perm({{ $permission->id }})">
                                    Lihat
                                </x-primary-button>
                                <x-danger-button x-on:click="deletePerm({{ $permission->id }})">
                                    Hapus
                                </x-danger-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                <p>Tidak ada data untuk ditampilkan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
</div>
