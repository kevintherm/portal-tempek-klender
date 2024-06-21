<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between mb-4 flex-wrap" x-data="{
                        format: (number) => {
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(number);
                        }
                    }">
                        <h4 class="font-semibold">Total Pengeluaran: <span
                                x-text="format(@json($expenses->sum('amount')))"></span></h4>
                        {{-- <x-secondary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'filter-tab')">
                            Filter
                        </x-secondary-button>

                        <a wire:navigate href="{{ route('posts.create') }}" class="btn-secondary">
                            Tambah Post
                        </a> --}}
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
                                        Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jumlah
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Deskripsi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
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
                                        text: 'Apakah Anda Yakin ?!',
                                        confirmButtonText: 'Batal',
                                        showDenyButton: true,
                                        denyButtonText: 'HAPUS',
                                    }).then((result) => {
                                        if (result.isDenied) {
                                            $wire.call('delete_expense', slug)
                                        }
                                    });
                                }
                            }">

                                @forelse ($expenses as $expense)
                                    <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white uppercase">
                                            Pengeluaran
                                        </th>
                                        <td class="px-6 py-4">
                                            <a wire:navigate href="{{ route('posts.show', $expense->activity->slug) }}"
                                                class="text-blue-500 hover:text-blue-600">
                                                {{ $expense->activity->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4" x-data="{
                                            format: (number) => {
                                                return new Intl.NumberFormat('id-ID', {
                                                    style: 'currency',
                                                    currency: 'IDR'
                                                }).format(number);
                                            }
                                        }"
                                            x-text="format(@json($expense->amount))"></td>
                                        <td class="px-6 py-4">
                                            {{ $expense->desc }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $expense->created_at->format('d F Y') }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-2 flex-wrap justify-evenly">
                                            {{-- <a wire:navigate class="btn-primary" href="">
                                                Lihat
                                            </a>
                                            <a wire:navigate class="btn-secondary" href="">
                                                Edit
                                            </a> --}}
                                            <x-danger-button @click="deletePost({{ $expense->id }})">
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

                        {{-- <section class="flex flex-col gap-1">
                            <p class="text-sm tracking-tight text-slate-500 ">Halaman {{ $posts->currentPage() }} dari
                                {{ $posts->lastPage() }}</p>
                            <p class="text-sm tracking-tight text-slate-500 ">Menampilkan {{ $posts->perPage() }}
                                per-halaman</p>
                            {{ $posts->links('pagination::simple-tailwind') }}
                        </section> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
