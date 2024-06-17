<?php

namespace App\Livewire;

use Livewire\Component;

class MemberDetails extends Component
{
    public $member;

    public function render()
    {
        return <<<'HTML'
            <div>
            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Nama
                </p>

                <p>{{ $member->name }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Foto Anggota
                </p>
                @if ($member->photo)
                    <img x-on:click="Swal.fire({
                        imageUrl: $el.src,
                        title: 'Foto '+$el.getAttribute('alt')
                    })"
                        src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}"
                        class="w-24 aspect-[3/4] object-cover rounded-lg">
                @else
                    <p class="text-sm italic">Anggota belum memiliki foto</p>
                @endif
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Status Hidup
                </p>

                <p>{{ $member->is_dead ? 'Meninggal' : 'Hidup' }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Status Keluarga
                </p>

                <p>{{ $member->status }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Umur
                </p>

                <p>{{ $member->age }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Pekerjaan
                </p>

                <p>{{ $member->job }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Nomor Telepon
                </p>

                <p>{{ $member->phone }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Alamat
                </p>

                <p>{{ $member->address }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Jabatan
                </p>

                <p>{{ $member->position }}</p>
            </div>

            <div class="mb-3">
                <p class="text-lg font-semibold">
                    Alasan Bergabung
                </p>

                <p>{{ $member->reason_to_join }}</p>
            </div>
        </div>
        HTML;
    }
}
