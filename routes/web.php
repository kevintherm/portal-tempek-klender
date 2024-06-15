<?php

use App\Http\Controllers\NewMemberController;
use App\Livewire\DashboardPosts;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Livewire\Volt\Volt;

Route::view('/', 'welcome')->name('home');

Route::view('/about', 'about')->name('about');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::view('', 'dashboard')
        ->name('dashboard');
    Route::resource('posts', PostController::class)
        ->except(['index', 'show']);
    Route::get('posts', DashboardPosts::class)->name('dashboard.posts');

    Volt::route('members/create', 'dashboard-create-member')->name('dashboard.members.create');
    Volt::route('members', 'dashboard-member')->name('dashboard.members');

});

Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/new-member', 'member.create')
    ->name('member.create');

Route::view('/gallery', 'gallery')
    ->name('gallery');


require __DIR__ . '/auth.php';
