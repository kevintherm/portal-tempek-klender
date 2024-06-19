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

                    <form wire:submit.prevent="save" class="py-4 w-full max-w-md">
                        <div class="py-4">
                            <h4 class="text-lg font-semibold">Edit Detail Anggota</h4>
                            <x-field-required-indicator /> mengindikasikan kolom yang diperlukan.
                        </div>

                        @if ($errors->any())
                            @dump($errors)
                        @endif


                        <div class="mb-4">
                            <x-input-label>Foto Anggota</x-input-label>
                            <input type="file" accept="image/png, image/gif, image/jpeg, image/webp, image/jpg"
                                wire:model.blur="photo" class="form-input w-full max-w-md" />
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" alt="{{ $name }}"
                                    class="w-3/4 object-cover aspect-[3/4] rounded-lg my-2">
                            @elseif ($member->photo)
                                <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}"
                                    class="w-3/4 object-cover aspect-[3/4] rounded-lg my-2">
                            @endif
                        </div>

                        <div class="mb-4">
                            <x-input-label>Status Hidup<x-field-required-indicator /></x-input-label>
                            <div class="flex items-center gap-2">
                                <x-text-input type="radio" name="is_dead" value="0" wire:model="is_dead" />
                                <x-input-label>Hidup</x-input-label>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-text-input type="radio" name="is_dead" value="1" wire:model="is_dead" />
                                <x-input-label>Meninggal</x-input-label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label>Nama<x-field-required-indicator /></x-input-label>
                            <x-text-input placeholder="Masukkan nama anggota" wire:model.blur="name"
                                class="w-full text-lg" name="name" required />
                            @error('name')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Status<x-field-required-indicator /></x-input-label>
                            <div class="flex justify-between gap-4">
                                <select name="status" class="form-input w-full max-w-md" wire:model="status">
                                    <option value="">Pilih Status</option>
                                    @foreach ($status_options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                                <button wire:click="addMoreChild" type="button" class="btn-secondary">
                                    Tambah Opsi Anak
                                </button>
                            </div>
                            @error('status')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        @if ($status != 'Kepala Keluarga')
                            <div class="mb-4" wire:ignore x-data="{
                                listen() {
                                    $($refs.select2).on('change', function(e) {
                                        var data = $($refs.select2).select2('val');
                                        @this.set('member_id', data)
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
                            <x-text-input placeholder="Masukkan tanggal lahir anggota" wire:model.blur="birth"
                                type="date" class="w-full text-lg" name="birth" required />
                            @error('birth')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Alamat<x-field-required-indicator /></x-input-label>
                            <x-text-input placeholder="Masukkan alamat anggota" wire:model.blur="address"
                                class="w-full text-lg" name="address" required />
                            @error('address')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Pekerjaan<x-field-required-indicator /></x-input-label>
                            <x-text-input placeholder="Masukkan pekerjaan anggota" wire:model.blur="job"
                                class="w-full text-lg" name="job" required />
                            @error('job')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Jabatan<x-field-required-indicator /></x-input-label>
                            <select wire:model.blur="position" name="position" required
                                class="w-full text-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option selected>Pilih Jabatan</option>
                                <option value="Anggota">Anggota</option>
                                <option value="Ketua">Ketua</option>
                                <option value="Wakil Ketua">Wakil Ketua</option>
                                <option value="Bendahara">Bendahara</option>
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('position')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>No Telepon/HP<x-field-required-indicator /></x-input-label>
                            <x-text-input placeholder="Masukkan telepon anggota" wire:model.blur="phone"
                                class="w-full text-lg" name="phone" required />
                            @error('phone')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Alasan ingin bergabung</x-input-label>
                            <x-text-input placeholder="Jelaskan alasan anggota" wire:model.blur="reason_to_join"
                                :textarea="true" rows="3" class="w-full text-lg" name="reason_to_join" />
                            @error('reason_to_join')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label>Tanggal Bergabung<x-field-required-indicator /></x-input-label>
                            <x-text-input wire:model="joined_at" type="date" class="w-full text-lg" name="joined_at"
                                required />
                            @error('joined_at')
                                <x-input-error :messages="$message" />
                            @enderror
                        </div>



                        <div class="mb-4">
                            <button type="button" class="btn-secondary" wire:click="addMember">Tambah Anggota
                                Keluarga</button>
                        </div>

                        <div class="mb-4 gap-2 flex">
                            <button type="submit" class="btn-secondary" onclick="history.back()">Kembali</button>
                            <button type="submit" class="btn-primary">Simpan</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
