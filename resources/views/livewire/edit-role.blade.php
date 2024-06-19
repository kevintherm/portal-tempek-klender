@assets
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endassets


<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jabatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form wire:submit.prevent="save" class="w-full max-w-md">
                        <div class="py-4">
                            <h4 class="text-lg font-semibold">Tambah Jabatan</h4>
                            <x-field-required-indicator /> mengindikasikan kolom yang diperlukan.
                        </div>

                        <div class="mb-3">
                            <x-input-label>
                                Nama Jabatan<x-field-required-indicator />
                            </x-input-label>
                            <x-text-input wire:model.live="name" autofocus class="w-full max-w-xs" />
                            @error('name')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-3">
                            <x-input-label>
                                Izin
                            </x-input-label>
                            <div class="select-wrapper" x-data="{
                                data: $wire.entangle('perms'),
                                show: false
                            }" x-on:click.outside="show=false">
                                <div class="flex flex-wrap gap-2 form-input max-w-xs">
                                    @foreach ($perms as $perm)
                                        @if (in_array($perm->id, $perms_id))
                                            <div class="form-input flex gap-2">
                                                <p>{{ $perm->name }}</p>
                                                <button type="button"
                                                    x-on:click="$wire.addOrDeletePerms({{ $perm->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach
                                    <input type="text" x-on:focus="show=true"
                                        class="border-transparent focus:border-transparent focus:ring-0 w-auto m-0 p-0"
                                        @input="$wire.getPerms($el.value)" />
                                </div>
                                <div x-show="show" x-collapse
                                    class="border-2 border-indigo-500 mt-1 rounded-lg p-2 shadow flex gap-2 flex-col max-h-64 overflow-y-auto">
                                    <p>Ketik Untuk Cari</p>
                                    @forelse ($perms as $perm)
                                        <button type="button"
                                            class="p-2 rounded-lg border active:bg-indigo-500/10 text-start {{ in_array($perm->id, $perms_id) ? 'bg-indigo-500/10' : '' }}"
                                            x-on:click="$wire.addOrDeletePerms({{ $perm->id }})">
                                            <p>{{ $perm->name }}</p>
                                        </button>
                                    @empty
                                        <p>Data Tidak Ditemukan.</p>
                                    @endforelse
                                </div>
                            </div>
                            @error('perms_id')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-3">
                            <x-input-label>
                                User
                            </x-input-label>
                            <div class="select-wrapper" x-data="{
                                data: $wire.entangle('users'),
                                show: false
                            }" x-on:click.outside="show=false">
                                <div class="flex flex-wrap gap-2 form-input max-w-xs">
                                    @foreach ($users as $user)
                                        @if (in_array($user->id, $users_id))
                                            <div class="form-input flex gap-2">
                                                <p>{{ $user->name }}</p>
                                                <button type="button"
                                                    x-on:click="$wire.addOrDeleteUsers({{ $user->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach
                                    <input type="text" x-on:focus="show=true"
                                        class="border-transparent focus:border-transparent focus:ring-0 w-auto m-0 p-0"
                                        @input="$wire.getUsers($el.value)" />
                                </div>
                                <div x-show="show" x-collapse
                                    class="border-2 border-indigo-500 mt-1 rounded-lg p-2 shadow flex gap-2 flex-col max-h-64 overflow-y-auto">
                                    <p>Ketik Untuk Cari</p>
                                    @forelse ($users as $user)
                                        <button type="button"
                                            class="p-2 rounded-lg border active:bg-indigo-500/10 text-start {{ in_array($user->id, $users_id) ? 'bg-indigo-500/10' : '' }}"
                                            x-on:click="$wire.addOrDeleteUsers({{ $user->id }})">
                                            <p>{{ $user->name }}</p>
                                        </button>
                                    @empty
                                        <p>Data Tidak Ditemukan.</p>
                                    @endforelse
                                </div>
                            </div>
                            @error('users_id')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-3">
                            <x-secondary-button onclick="history.back()">
                                Batal
                            </x-secondary-button>
                            <x-primary-button>
                                Simpan
                            </x-primary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
