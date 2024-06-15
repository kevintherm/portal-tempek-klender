<?php

use App\Models\User;
use App\Models\Member;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;

new class extends Component {
    use WithPagination;
    use LivewireAlert;

    public $selectedMember = null;
    public $read_only = true;

    public $user_id;
    public $disabled_user_input = true;

    public $user_email = '';

    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $age;
    #[Validate('required')]
    public $job;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $phone;
    #[Validate('required')]
    public $reason_to_join;
    #[Validate('nullable')]
    public $position;

    public function with(): array
    {
        return [
            'members' => Member::filters(request(['name', 'phone', 'address']))->paginate(10),
        ];
    }

    public function delete_member(Member $member)
    {
        $member->delete();

        $this->alert('success', 'Berhasil dihapus dari daftar!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    private function fill_inputs()
    {
        $this->name = old('age', $this->selectedMember->name);
        $this->age = old('age', $this->selectedMember->age);
        $this->job = old('age', $this->selectedMember->job);
        $this->address = old('age', $this->selectedMember->address);
        $this->phone = old('age', $this->selectedMember->phone);
        $this->reason_to_join = old('age', $this->selectedMember->reason_to_join);
    }

    function edit_member(Member $member)
    {
        $this->dispatch('open-modal', 'edit-member');
        $this->read_only = false;
        $this->selectedMember = $member;
        $this->fill_inputs();
    }

    function save_member()
    {
        $this->validate();

        // check user exists
        if ($this->user_email ?? false) {
            if ($user = User::where('email', $this->user_email)->first()) {
                if (Member::where('user_id', $user->id)->count() > 0) {
                    throw ValidationException::withMessages([
                        'user_email' => __('Member dengan user account sudah ada, silahkan hubungi admin yang bersangkutan.'),
                    ]);
                }

                $this->user_id = $user->id;
            } else {
                throw ValidationException::withMessages([
                    'user_email' => __('User account tidak ada, silahkan hubungi admin yang bersangkutan.'),
                ]);
            }
        }

        $this->selectedMember->update($this->only(['name', 'age', 'job', 'address', 'phone', 'reason_to_join']));

        $this->dispatch('close-modal', 'edit-member');

        $this->alert('success', 'Berhasil meng-update detail member.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);

        $this->reset();
    }

    function show_member(Member $member)
    {
        $this->dispatch('open-modal', 'edit-member');
        $this->read_only = true;
        $this->selectedMember = $member;
        $this->fill_inputs();
    }

    function toggle_user_input()
    {
        $this->disabled_user_input = !$this->disabled_user_input;
    }
}; ?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <x-modal name="edit-member" :show="$errors->isNotEmpty()" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __(($read_only ? 'Lihat' : 'Edit') . ' Detail Anggota') }}
            </h2>

            @if ($selectedMember)
                <form wire:submit="save_member" class="py-4 w-full max-w-md">
                    <div class="mb-4">
                        <div class="mb-4" x-data="{ disabled: @entangle('disabled_user_input') }">
                            <x-input-label @click="$wire.call('toggle_user_input')">User</x-input-label>
                            <x-text-input x-show="!disabled" x-collapse wire:model="user_email" class="w-full text-lg"
                                user_email="user_email" :disabled="$read_only" :readonly="$read_only" />
                            @if ($selectedMember->user)
                                <p>user: {{ $selectedMember->user->email }}</p>
                            @endif
                            @error('user_email')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <x-input-label>Nama</x-input-label>
                        <x-text-input wire:model="name" class="w-full text-lg" name="name" :disabled="$read_only"
                            :readonly="$read_only" />
                        @error('name')
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label>Umur</x-input-label>
                        <x-text-input wire:model="age" type="number" class="w-full text-lg" name="age"
                            :disabled="$read_only" :readonly="$read_only" />
                        @error('age')
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label>Alamat</x-input-label>
                        <x-text-input wire:model="address" class="w-full text-lg" name="address" :disabled="$read_only"
                            :readonly="$read_only" />
                        @error('address')
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label>Pekerjaan</x-input-label>
                        <x-text-input wire:model="job" class="w-full text-lg" name="job" :disabled="$read_only"
                            :readonly="$read_only" />
                        @error('job')
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label>Jabatan</x-input-label>
                        <select wire:model="position" name="position"
                            class="w-full text-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            {{ $read_only ? 'disabled readonly' : '' }}>
                            <option value="Anggota">
                                Anggota
                            </option>
                            <option value="Ketua">
                                Ketua
                            </option>
                            <option value="Wakil Ketua">
                                Wakil Ketua
                            </option>
                            <option value="Bendahara">
                                Bendahara
                            </option>
                            <option value="Sekretaris">
                                Sekretaris
                            </option>
                            <option value="Lainnya">
                                Lainnya
                            </option>
                        </select>
                        @error('position')
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label>No Telepon/HP</x-input-label>
                        <x-text-input wire:model="phone" class="w-full text-lg" name="phone" :disabled="$read_only"
                            :readonly="$read_only" />
                        @error('phone')
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label>Alasan ingin bergabung</x-input-label>
                        <x-text-input wire:model="reason_to_join" :textarea="true" rows="3" :disabled="$read_only"
                            :readonly="$read_only" class="w-full text-lg" name="reason_to_join" />
                        @error('reason_to_join')
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    @if (!$read_only)
                        <div class="mb-4">
                            <button type="submit" class="btn-primary">
                                Simpan
                            </button>
                        </div>
                    @endif

                </form>
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

                        <a href="{{ route('dashboard.members.create') }}" class="btn-secondary">
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
                                        <td class="px-6 py-4 ">
                                            <button class="btn-primary"
                                                wire:click="show_member({{ $member->id }})">
                                                Lihat
                                            </button>
                                            <button class="btn-secondary"
                                                wire:click="edit_member({{ $member->id }})">
                                                Edit
                                            </button>
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
