<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <x-modal name="filter-tab" :show="$errors->isNotEmpty()" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Filter') }}
            </h2>

            <form class="py-4">
                <div class="mb-2">
                    <x-input-label>
                        Tipe
                    </x-input-label>
                    <select
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="type" name="type">
                        <option {{ request('type') == '' ? 'selected' : '' }} value="">
                            Semua
                        </option>
                        <option {{ request('type') == 'post' ? 'selected' : '' }} value="post">
                            Postingan
                        </option>
                        <option {{ request('type') == 'kegiatan' ? 'selected' : '' }} value="kegiatan">
                            Kegiatan
                        </option>
                        <option {{ request('type') == 'pengumuman' ? 'selected' : '' }} value="pengumuman">
                            Pengumuman</option>
                    </select>
                </div>

                <div class="mb-2">
                    <x-input-label>
                        Judul
                    </x-input-label>
                    <x-text-input name="title" :value="request('title')" />
                </div>

                <div class="mb-2">
                    <x-input-label>
                        Tanggal Dibuat
                    </x-input-label>
                    <div class="flex flex-wrap items-center">
                        <x-text-input type="date" wire:change="get_date_between" wire:model="date1" name="date1" />
                        <span>-</span>
                        <x-text-input type="date" wire:change="get_date_between" wire:model="date2" name="date2" />
                    </div>
                    <p class="dark:text-gray-100" x-text="$wire.date_between"></p>
                </div>

                <div class="mb-2">
                    <x-input-label>
                        Pernah Diedit
                    </x-input-label>
                    <select
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="edited">
                        <option {{ request('edited') == '' ? 'selected' : '' }} value="">Semua</option>
                        <option {{ request('edited') == 'true' ? 'selected' : '' }} value="true">Ya</option>
                        <option {{ request('edited') == 'false' ? 'selected' : '' }} value="false">Tidak</option>
                    </select>
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
                        <h4 class="font-semibold">Jumlah Post: {{ $posts->count() }}</h4>
                        <x-secondary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'filter-tab')">
                            Filter
                        </x-secondary-button>

                        <a href="{{ route('posts.create') }}" class="btn-secondary">
                            Tambah Post
                        </a>
                    </div>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Tipe
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Judul
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Dibuat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pernah Diedit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody x-data="{
                                deletePost: (slug) => {
                                    Swal.fire({
                                        title: 'Konfirmasi Hapus',
                                        text: 'Hapus postingan: ' + slug + '?',
                                        confirmButtonText: 'Batal',
                                        showDenyButton: true,
                                        denyButtonText: 'HAPUS',
                                    }).then((result) => {
                                        if (result.isDenied) {
                                            $wire.call('delete_post', slug)
                                        }
                                    });
                                }
                            }">

                                @forelse ($posts as $post)
                                    <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white uppercase">
                                            {{ $post->type }}
                                        </th>
                                        <td class="px-6 py-4 uppercase">
                                            {{ $post->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $post->created_at->format('d F Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $post->created_at != $post->updated_at ? 'Ya' : 'Tidak' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a class="btn-primary" href="{{ route('posts.show', $post->slug) }}">
                                                Lihat
                                            </a>
                                            <a class="btn-secondary" href="{{ route('posts.edit', $post->slug) }}">
                                                Edit
                                            </a>
                                            <x-danger-button @click="deletePost('{{ $post->slug }}')">
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

                        <section class="flex flex-col gap-1">
                            <p class="text-sm tracking-tight text-slate-500 ">Halaman {{ $posts->currentPage() }} dari
                                {{ $posts->lastPage() }}</p>
                            <p class="text-sm tracking-tight text-slate-500 ">Menampilkan {{ $posts->perPage() }}
                                per-halaman</p>
                            {{ $posts->links('pagination::simple-tailwind') }}
                        </section>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
