    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Roles Manager') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                    role="alert">
                    <span class="font-medium">PERINGATAN!</span>
                    Perubahan Jabatan dan Izin harus dilakukan dengan hati-hati dan didampingi dengan saran
                    Administrator.
                    Kesalahan dalam melakukan perubahan
                    dapat menyebabkan masalah keamanan!
                </div>

                {{-- Roles --}}
                @livewire('RolesTable')

                {{-- Permissions --}}
                @livewire('PermissionsTable')

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{ route('staff.history') }}" class="text-blue-500 hover:text-blue-700" wire:navigate>
                            Lihat Riwayat Staff
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
