<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap gap-8">

                    <div class="card w-64 h-24 rounded-lg shadow-lg overflow-hidden">
                        <div class="wrapper h-2/3 w-full bg-orange-400 px-4 py-2">
                            <div class="flex items-center flex-row gap-2">
                                <div class="px-3 py-2 bg-teal-300/80 inline rounded-full">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                <div>
                                    <p class="text-white">Selamat Datang,</p>
                                    <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer dark:bg-gray-100 px-4 py-1">
                            <a href="{{ route('profile') }}"
                                class="font-semibold text-orange-400 hover:text-orange-600 transition text-sm">Buka
                                Profil</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="my-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h4 class="p-6 font-bold text-orange-400">Postingan</h4>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap gap-8">



                    <div class="card w-64 h-24 rounded-lg shadow-lg overflow-hidden">
                        <div class="wrapper h-2/3 w-full bg-slate-300 px-4 py-2">
                            <div class="flex items-center flex-row gap-2">
                                <div class="px-3 py-2 bg-teal-300/80 inline rounded-full">
                                    <i class="fa-regular fa-newspaper fa-sm text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-white">Jumlah Post</p>
                                    <p class="font-semibold text-white">
                                        {{ App\Models\Post::where('type', 'post')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="footer dark:bg-gray-100 px-4 py-1">
                            <a href="{{ route('dashboard.posts', ['type' => 'post']) }}"
                                class="font-semibold text-orange-400 hover:text-orange-600 transition text-sm">Pergi ke
                                Dashboard</a>
                        </div>
                    </div>

                    <div class="card w-64 h-24 rounded-lg shadow-lg overflow-hidden">
                        <div class="wrapper h-2/3 w-full bg-slate-400 px-4 py-2">
                            <div class="flex items-center flex-row gap-2">
                                <div class="px-3 py-2 bg-teal-300/80 inline rounded-full">
                                    <i class="fa-solid fa-calendar-days fa-sm text-slate-700"></i>

                                </div>
                                <div>
                                    <p class="text-white">Jumlah Kegiatan</p>
                                    <p class="font-semibold text-white">
                                        {{ App\Models\Post::where('type', 'kegiatan')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="footer dark:bg-gray-100 px-4 py-1">
                            <a href="{{ route('dashboard.posts', ['type' => 'kegiatan']) }}"
                                class="font-semibold text-orange-400 hover:text-orange-600 transition text-sm">Pergi ke
                                Dashboard</a>
                        </div>
                    </div>

                    <div class="card w-64 h-24 rounded-lg shadow-lg overflow-hidden">
                        <div class="wrapper h-2/3 w-full bg-slate-500 px-4 py-2">
                            <div class="flex items-center flex-row gap-2">
                                <div class="px-3 py-2 bg-teal-300/80 inline rounded-full">
                                    <i class="fa-solid fa-bullhorn fa-sm text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-white">Jumlah Pengumuman</p>
                                    <p class="font-semibold text-white">
                                        {{ App\Models\Post::where('type', 'pengumuman')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="footer dark:bg-gray-100 px-4 py-1">
                            <a href="{{ route('dashboard.posts', ['type' => 'pengumuman']) }}"
                                class="font-semibold text-orange-400 hover:text-orange-600 transition text-sm">Pergi ke
                                Dashboard</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="my-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h4 class="p-6 font-bold text-orange-400">Anggota Tempek</h4>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap gap-8">



                    <div class="card w-64 h-24 rounded-lg shadow-lg overflow-hidden">
                        <div class="wrapper h-2/3 w-full bg-slate-300 px-4 py-2">
                            <div class="flex items-center flex-row gap-2">
                                <div class="px-3 py-2 bg-teal-300/80 inline rounded-full">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                <div>
                                    <p class="text-white">Jumlah Anggota</p>
                                    <p class="font-semibold text-white">
                                        {{ App\Models\Member::count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="footer dark:bg-gray-100 px-4 py-1">
                            <a href="{{ route('dashboard.members') }}"
                                class="font-semibold text-orange-400 hover:text-orange-600 transition text-sm">Pergi ke
                                Dashboard</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
