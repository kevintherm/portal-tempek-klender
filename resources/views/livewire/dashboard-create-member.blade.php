@assets
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endassets

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Members') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form wire:submit.prevent="save_members" class="py-4 w-full max-w-md">
                        <div class="py-4">
                            <h4 class="text-lg font-semibold">Tambah Anggota Baru</h4>
                            <x-field-required-indicator /> mengindikasikan kolom yang diperlukan.
                        </div>

                        @if ($errors->any())
                            @dump($errors)
                        @endif

                        @foreach ($members as $index => $member)
                            <div class="mb-4 border rounded-lg p-4" wire:key="member-{{ $index }}">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold">Anggota {{ $index + 1 }}</h3>
                                    @if (count($members) > 1)
                                        <button type="button" class="text-red-500"
                                            wire:click="removeMember({{ $index }})">Hapus</button>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <x-input-label>Foto Anggota</x-input-label>
                                    <input type="file"
                                        accept="image/png, image/gif, image/jpeg, image/webp, image/jpg"
                                        wire:model="photos.{{ $index }}" class="form-input w-full max-w-md">
                                    @error('photos.*')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                    @if (isset($photos[$index]) && $photos[$index])
                                        <div class="flex justify-center my-2">
                                            <img class="w-3/4 object-cover aspect-[3/4] rounded-lg"
                                                src="{{ $photos[$index]->temporaryUrl() }}">
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <x-input-label>Status Hidup<x-field-required-indicator /></x-input-label>
                                    <div class="flex items-center gap-2">
                                        <x-text-input type="radio" name="is_dead" value="false"
                                            wire:model.blur="is_dead" :checked="isset($member['is_dead']) && !$member['is_dead']" />
                                        <x-input-label>Hidup</x-input-label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-text-input type="radio" name="is_dead" value="true"
                                            wire:model.blur="is_dead" :checked="isset($member['is_dead']) && $member['is_dead']" />
                                        <x-input-label>Meninggal</x-input-label>
                                    </div>
                                </div>

                                <div class="mb-4" x-data="{}">
                                    <x-input-label>Nama<x-field-required-indicator /></x-input-label>
                                    <x-text-input placeholder="Masukkan nama anggota"
                                        wire:model.blur="members.{{ $index }}.name" class="w-full text-lg"
                                        name="name" required x-ref="name" />
                                    @error('members.' . $index . '.name')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                <div class="mb-4" x-data="{
                                    options: ['Kepala Keluarga', 'Istri', 'Lainnya', 'Anak Ke-1'],
                                    addMoreChild() {
                                        // Find the highest current index for 'Anak Ke-'
                                        let anakIndexes = this.options
                                            .filter(option => option.startsWith('Anak Ke-'))
                                            .map(option => parseInt(option.split('Anak Ke-')[1]));
                                
                                        let nextIndex = anakIndexes.length > 0 ? Math.max(...anakIndexes) + 1 : 1;
                                
                                        this.options.push(`Anak Ke-${nextIndex}`);
                                    }
                                }">
                                    <x-input-label>Status<x-field-required-indicator /></x-input-label>
                                    <div class="flex justify-between gap-4">
                                        <select name="status" wire:model.live="members.{{ $index }}.status"
                                            class="form-input w-full max-w-md">
                                            <option disabled selected>Pilih Status</option>
                                            <template x-for="option in options">
                                                <option :value="option" x-text="option">
                                                </option>
                                            </template>
                                        </select>
                                        <button @click="addMoreChild" type="button" class="btn-secondary">
                                            Tambah Opsi Anak
                                        </button>
                                    </div>
                                    @error('members.' . $index . '.status')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                @if ($members[$index]['status'] && $members[$index]['status'] != 'Kepala Keluarga')
                                    <div class="mb-4" wire:ignore x-data="{
                                        listen() {
                                            $($refs.select2).on('change', function(e) {
                                                var data = $($refs.select2).select2('val');
                                                @this.set('members.{{ $index }}.member_id', data)
                                            })
                                        }
                                    }" x-init="listen">
                                        <x-input-label>Anggota Keluarga Dari</x-input-label>
                                        <select type="select" class="form-input w-full max-w-md" x-ref="select2"
                                            x-init="$($el).select2({
                                                ajax: {
                                                    url: '{{ route('utils.get_members_by_name') }}',
                                                    dataType: 'json',
                                                    data: function(params) {
                                                        var query = {
                                                            search: params.term,
                                                            status: 'head',
                                                            type: 'public'
                                                        }
                                                        return query;
                                                    }
                                                }
                                            });">
                                            <option disabled selected>Cari anggota</option>
                                        </select>
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <x-input-label>Tanggal Lahir<x-field-required-indicator /></x-input-label>
                                    <x-text-input placeholder="Masukkan umur anggota"
                                        wire:model.blur="members.{{ $index }}.birth" type="date"
                                        class="w-full text-lg" name="birth" required />
                                    @error('members.' . $index . '.birth')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label>Alamat<x-field-required-indicator /></x-input-label>
                                    <x-text-input placeholder="Masukkan alamat anggota"
                                        wire:model.blur="members.{{ $index }}.address" class="w-full text-lg"
                                        name="address" required />
                                    @error('members.' . $index . '.address')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label>Pekerjaan<x-field-required-indicator /></x-input-label>
                                    <x-text-input placeholder="Masukkan pekerjaan anggota"
                                        wire:model.blur="members.{{ $index }}.job" class="w-full text-lg"
                                        name="job" required />
                                    @error('members.' . $index . '.job')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label>Jabatan<x-field-required-indicator /></x-input-label>
                                    <select wire:model.blur="members.{{ $index }}.position" name="position"
                                        required
                                        class="w-full text-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option>Pilih Jabatan</option>
                                        @foreach ($possibleRoles as $role)
                                            <option value="{{ $role->name }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('members.' . $index . '.position')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label>No Telepon/HP<x-field-required-indicator /></x-input-label>
                                    <x-text-input placeholder="Masukkan telepon anggota"
                                        wire:model.blur="members.{{ $index }}.phone" class="w-full text-lg"
                                        name="phone" required />
                                    @error('members.' . $index . '.phone')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label>Alasan ingin bergabung</x-input-label>
                                    <x-text-input placeholder="Jelaskan alasan anggota"
                                        wire:model.blur="members.{{ $index }}.reason_to_join" :textarea="true"
                                        rows="3" class="w-full text-lg" name="reason_to_join" />
                                    @error('members.' . $index . '.reason_to_join')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label>Tanggal Bergabung<x-field-required-indicator /></x-input-label>
                                    <x-text-input wire:model.blur="members.{{ $index }}.joined_at"
                                        type="date" class="w-full text-lg" name="joined_at" required />
                                    @error('members.' . $index . '.joined_at')
                                        <x-input-error :messages="$message" />
                                    @enderror
                                </div>


                            </div>
                        @endforeach

                        <div class="mb-4">
                            <button type="button" class="btn-secondary" wire:click="addMember">Tambah Anggota
                                Keluarga</button>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn-primary">Simpan</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
