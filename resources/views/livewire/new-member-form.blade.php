<form wire:submit="save" class="py-4 w-full max-w-md">
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
        <x-input-label>No Telepon/HP</x-input-label>
        <x-text-input wire:model="phone" class="w-full text-lg" name="phone" />
        @error('phone')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div class="mb-4">
        <x-input-label>Alasan ingin bergabung</x-input-label>
        <x-text-input wire:model="reason_to_join" :textarea="true" rows="3" class="w-full text-lg"
            name="reason_to_join" />
        @error('reason_to_join')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div x-data="recaptcha" x-init="render" class="mb-4" wire:ignore>
        <div id="captcha_div"></div>

    </div>
    @error('captcha')
        <x-input-error :messages="$message" class="mb-4" />
    @enderror

    <div class="mb-4">
        <button type="submit" class="flex w-full justify-center btn-primary">
            Submit
        </button>
    </div>

</form>

@script
    <script>
        Alpine.data('recaptcha', () => {
            return {
                render() {
                    grecaptcha.ready(() => {
                        grecaptcha.render('captcha_div', {
                            'sitekey': '{{ config('services.recaptcha.key') }}',
                            'callback': (response) => {
                                @this.set('captcha', response)
                            }
                        })
                    })
                }
            }
        })
        $wire.on('reset-captcha', () => {
            grecaptcha.reset();
        });
    </script>
@endscript
