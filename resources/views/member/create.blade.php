<x-main-layout>

    <x-slot name="foot">
        <script src="https://www.google.com/recaptcha/api.js?&render=explicit" async defer></script>



    </x-slot>

    <x-slot name="header">
        @livewire('HeroSection', ['height' => 30, 'text' => 'Daftar Anggota'])
    </x-slot>

    <div>


        <div class="flex flex-col justify-center items-center">
            <h3 class="font-semibold">
                Formulir Pendaftaran Anggota
            </h3>
            @livewire('NewMemberForm')
        </div>
    </div>

</x-main-layout>
