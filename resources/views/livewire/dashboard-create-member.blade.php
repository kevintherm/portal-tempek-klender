<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form wire:submit="save" class="py-4 w-full max-w-md">
                        <div class="mb-4" x-data="{ disabled: @entangle('disabled_user_input') }">
                            <x-input-label @click="$wire.call('toggle_user_input')">User (optional)</x-input-label>
                            <x-text-input x-show="!disabled" x-collapse wire:model="user_email" class="w-full text-lg"
                                user_email="user_email" />
                            @error('user_email')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Nama</x-input-label>
                            <x-text-input wire:model="name" class="w-full text-lg" name="name" />
                            @error('name')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Umur</x-input-label>
                            <x-text-input wire:model="age" type="number" class="w-full text-lg" name="age" />
                            @error('age')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Alamat</x-input-label>
                            <x-text-input wire:model="address" class="w-full text-lg" name="address" />
                            @error('address')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Pekerjaan</x-input-label>
                            <x-text-input wire:model="job" class="w-full text-lg" name="job" />
                            @error('job')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>No Telepon</x-input-label>
                            <x-text-input wire:model="phone" class="w-full text-lg" name="phone" />
                            @error('phone')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Alasan Bergabung</x-input-label>
                            <x-text-input wire:model="reason_to_join" :textarea="true" rows="3"
                                class="w-full text-lg" name="reason_to_join" />
                            @error('reason_to_join')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label class="mb-4 text-lg">
                                Data Keluarga &downarrow;
                            </x-input-label>
                            <div class="mb-4">
                                <div class="mb-2">
                                    <x-input-label value="Nama Istri" />
                                    <x-text-input name="family.wife" />
                                    @error('wife')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>
                                <div class="mb-2 flex flex-row gap-2">
                                    <x-text-input type="checkbox" name="isDead" />
                                    <x-input-label value="Almarhum" />
                                </div>
                            </div>
                            <div class="mb-4">
                                <x-input-label value="Anak Pertama" />
                                <x-text-input name="family.childs[]" />
                            </div>
                            <div class="mb-4">
                                <x-input-label value="Anak Kedua" />
                                <x-text-input name="family.childs[]" />
                            </div>
                            <div class="mb-4">
                                <x-input-label value="Anak Ketiga" />
                                <x-text-input name="family.childs[]" />
                            </div>
                            <div class="mb-4">
                                <x-input-label value="Anak Keempat" />
                                <x-text-input name="family.childs[]" />
                                @error('childs.*')
                                    <x-input-error :messages="$message" />
                                @enderror
                            </div>

                        </div>


                        @error('captcha')
                            <x-input-error :messages="$message" class="mb-4" />
                        @enderror

                        <div class="mb-4">
                            <button type="submit" class="btn-primary">
                                Simpan
                            </button>
                            <x-secondary-button onclick="history.back()">
                                Kembali
                            </x-secondary-button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
