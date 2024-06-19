    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Izin') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <form wire:submit.prevent="save" class="w-full max-w-md">
                            <div class="py-4">
                                <h4 class="text-lg font-semibold">Tambah Izin Baru</h4>
                                <p>
                                    <x-field-required-indicator /> Mengindikasikan kolom yang diperlukan.
                                </p>
                                <p>* Penamaan izin sebaiknya dalam bahasa Inggris untuk semantik sistem.</p>
                                <p>* Penamaan izin harus menggunakan huruf kecil.</p>
                            </div>

                            <div class="mb-3">
                                <x-input-label>
                                    Nama Izin<x-field-required-indicator />
                                </x-input-label>
                                <x-text-input wire:model.blur="name" autofocus />
                                @error('name')
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
