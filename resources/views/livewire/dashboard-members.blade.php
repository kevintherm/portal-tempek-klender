<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <x-modal name="show-member" :show="$errors->isNotEmpty()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ 'Detail Anggota' }}
                </h2>
                <button x-on:click="$dispatch('close-modal', 'show-member')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            @if ($selectedMember)
                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Foto Anggota
                    </p>
                    @if ($selectedMember->photo)
                        <a href="{{ route('members.history.photo', $selectedMember->id) }}" wire:navigate
                            class="text-blue-500 hover:text-blue-700 mb-2">
                            Lihat Histori Foto
                        </a>
                        <img x-on:click="Swal.fire({
                        imageUrl: $el.src,
                        title: 'Foto '+$el.getAttribute('alt')
                    })"
                            src="{{ Storage::url($selectedMember->photo) }}" alt="{{ $selectedMember->name }}"
                            class="w-24 aspect-[3/4] object-cover rounded-lg">
                    @else
                        <p class="text-sm italic">Anggota belum memiliki foto</p>
                    @endif
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Nama
                    </p>

                    <p>{{ $selectedMember->name }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Status Hidup
                    </p>

                    <p>{{ $selectedMember->is_dead ? 'Meninggal' : 'Hidup' }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Status Keluarga
                    </p>

                    <p>{{ $selectedMember->status }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Umur
                    </p>

                    <p>{{ $selectedMember->age }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Pekerjaan
                    </p>

                    <p>{{ $selectedMember->job }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Nomor Telepon
                    </p>

                    <p>{{ $selectedMember->phone }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Alamat
                    </p>

                    <p>{{ $selectedMember->address }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Jabatan
                    </p>

                    <p>{{ $selectedMember->position }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold">
                        Alasan Bergabung
                    </p>

                    <p>{{ $selectedMember->reason_to_join }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-lg font-semibold" wire:click="toggleShowMembersFamily">
                        Anggota Keluarga
                    </p>
                    @if (!$showMembersFamily && $selectedMember->family->count() > 0)
                        <p class="text-sm italic cursor-pointer" wire:click="toggleShowMembersFamily">Klik Untuk Melihat
                        </p>
                    @endif
                    @if ($selectedMember->family->count() < 1)
                        <p class="text-sm italic">Anggota Belum Memiliki Keluarga
                        </p>
                    @endif
                    @if ($showMembersFamily)
                        @if ($selectedMember->family->count() > 0)
                            @foreach ($selectedMember->family as $i => $member)
                                <div class="my-4">
                                    <x-input-label>
                                        Anggota Keluarga {{ $i + 1 }}:
                                    </x-input-label>
                                    <div class="ps-8 md:ps-12">
                                        @livewire('MemberDetails', ['member' => $member])
                                    </div>
                                </div>
                            @endforeach
                        @elseif ($selectedMember->family_head)
                            <div class="my-4">
                                <x-input-label>
                                    Keluarga Dari:
                                </x-input-label>
                                <div class="ps-8 md:ps-12">
                                    @livewire('MemberDetails', ['member' => $selectedMember->family_head])
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            @endif

        </div>
    </x-modal>

    <x-modal name="filter-tab" :show="$errors->isNotEmpty()" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Filter') }}
            </h2>

            <form class="py-4">

                <div class="mb-2">
                    <x-input-label>
                        Cari berdasarkan nama anggota
                    </x-input-label>
                    <x-text-input name="name" :value="request('name')" />
                </div>

                <div class="mb-2">
                    <x-input-label>
                        Cari berdasarkan no hp
                    </x-input-label>
                    <x-text-input name="phone" :value="request('phone')" />
                </div>

                <div class="mb-2">
                    <x-input-label>
                        Cari berdasarkan alamat
                    </x-input-label>
                    <x-text-input name="address" placeholder="masukan alamat" :value="request('address')" />
                </div>

                <x-primary-button type="submit">
                    Terapkan Filter
                </x-primary-button>
                <a href="{{ url()->current() }}" class="btn-secondary">
                    Reset Filter
                </a>
            </form>

        </div>
    </x-modal>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between mb-4 flex-wrap">
                        <h4 class="font-semibold">Jumlah Member: {{ $members->count() }}</h4>
                        <x-secondary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'filter-tab')">
                            Filter
                        </x-secondary-button>

                        <a wire:navigate href="{{ route('dashboard.members.create') }}" class="btn-secondary">
                            Tambah Member
                        </a>
                    </div>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Umur
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Profesi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        No HP
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Alasan bergabung
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody x-data="{
                                deleteMember: (slug) => {
                                    Swal.fire({
                                        title: 'Konfirmasi Hapus',
                                        text: 'Hapus anggota dari daftar?',
                                        confirmButtonText: 'Batal',
                                        showDenyButton: true,
                                        denyButtonText: 'HAPUS',
                                    }).then((result) => {
                                        if (result.isDenied) {
                                            $wire.call('delete_member', slug)
                                        }
                                    });
                                }
                            }">
                                @forelse ($members as $member)
                                    <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white uppercase">
                                            {{ $member->name }}
                                        </th>
                                        <td class="px-6 py-4 uppercase">
                                            {{ $member->age }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $member->job }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $member->phone }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $member->address }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="line-clamp-1">
                                                {{ $member->reason_to_join }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 flex gap-2 flex-wrap justify-evenly">
                                            <button class="btn-primary"
                                                x-on:click="$wire.show_member({{ $member->id }})">
                                                Lihat
                                            </button>
                                            <a wire:navigate class="btn-secondary"
                                                href="{{ route('dashboard.members.edit', $member->id) }}">
                                                Edit
                                            </a>
                                            <x-danger-button @click="deleteMember('{{ $member->id }}')">
                                                Hapus
                                            </x-danger-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Tidak ada item.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <section class="flex flex-col gap-1">
                        <p class="text-sm tracking-tight text-slate-500 ">Halaman {{ $members->currentPage() }} dari
                            {{ $members->lastPage() }}</p>
                        <p class="text-sm tracking-tight text-slate-500 ">Menampilkan {{ $members->perPage() }}
                            per-halaman</p>
                        {{ $members->links('pagination::simple-tailwind') }}
                    </section>

                </div>
            </div>
        </div>
    </div>

</div>
