<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900 dark:text-gray-100">

        <x-modal name="role-details" :show="$errors->isNotEmpty()">
            <div class="p-6">
                <div class="flex justify-between">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Lihat Detail Jabatan') }}
                    </h2>
                    <button x-on:click="$dispatch('close-modal', 'role-details')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if ($selectedRole)
                    <div>
                        <div class="mb-3">
                            <p class="text-lg font-semibold">
                                Jabatan
                            </p>
                            <p>
                                {{ $selectedRole->name }}
                            </p>
                        </div>
                        <div class="mb-3">
                            <div class="text-lg font-semibold">
                                Mempunyai Izin Untuk:
                            </div>
                            <ul>
                                @foreach ($selectedRole->permissions as $perm)
                                    <li>
                                        <p>{{ $perm->name }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mb-3">
                            <div class="text-lg font-semibold">
                                User
                            </div>
                            <ul>
                                @foreach ($selectedRole->users as $user)
                                    <li>
                                        <p>{{ $user->name }}</p>
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
            <h3 class="text-lg font-semibold">Jabatan</h3>
            <a wire:navigate href="{{ route('roles.create') }}" class="btn-secondary">
                Tambah Jabatan
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
                    @forelse ($roles as $i => $role)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 capitalize">
                                {{ $i + 1 }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white capitalize">
                                {{ $role->name }}
                            </th>
                            <td class="px-6 py-4 flex gap-2 flex-wrap justify-center" x-data="{
                                deleteRole: (slug) => {
                                    Swal.fire({
                                        title: 'KONFIRMASI HAPUS',
                                        text: 'PERINGATAN! APAKAH ANDA YAKIN INGIN MENGHAPUS JABATAN ?',
                                        confirmButtonText: 'Batal',
                                        showDenyButton: true,
                                        denyButtonText: 'HAPUS',
                                    }).then((result) => {
                                        if (result.isDenied) {
                                            $wire.call('delete_role', slug)
                                        }
                                    });
                                }
                            }">
                                <x-primary-button x-on:click.prevent="$wire.show_role({{ $role->id }})">
                                    Lihat
                                </x-primary-button>
                                <a wire:navigate class="btn-secondary" href="{{ route('roles.edit', $role->id) }}">
                                    Edit
                                </a>
                                <x-danger-button x-on:click.prevent="deleteRole({{ $role->id }})">
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
