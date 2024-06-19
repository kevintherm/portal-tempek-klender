<?php

use App\Http\Controllers\UtilsController;
use App\Livewire\CreatePermission;
use App\Livewire\CreateRole;
use App\Livewire\DashboardEditMember;
use App\Livewire\EditRole;
use App\Livewire\MemberPhotoHistory;
use App\Livewire\RoleManager;
use App\Models\User;
use Livewire\Volt\Volt;
use App\Livewire\DashboardPosts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewMemberController;

if (env('APP_DEBUG')) {
    $user = User::first();

    Auth::login($user);
}

Route::get('/get-birthday-reminder', [UtilsController::class, 'birthdayReminder']);

Route::prefix('roles')->group(function () {
    Route::get('/', RoleManager::class)->name('roles.index');
    Route::get('/create', CreateRole::class)->name('roles.create');
    Route::get('/{role}/edit', EditRole::class)->name('roles.edit');
});

Route::prefix('perms')->group(function () {
    Route::get('/create', CreatePermission::class)->name('perms.create');
});

Route::view('/', 'welcome')->name('home');

Route::view('/about', 'about')->name('about');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::view('', 'dashboard')
        ->name('dashboard');
    Route::resource('posts', PostController::class)
        ->except(['index', 'show']);
    Route::get('posts', DashboardPosts::class)->name('dashboard.posts');

    Volt::route('members/create', 'dashboard-create-member')->name('dashboard.members.create');
    Volt::route('members', 'dashboard-members')->name('dashboard.members');


    Route::get('members/getMembersByName', [UtilsController::class, 'getMembersByName'])->name('utils.get_members_by_name');

    Route::get('members/{member}/photo_history', MemberPhotoHistory::class)
        ->name('members.history.photo');

    Route::get('members/{member}/edit', DashboardEditMember::class)
        ->name('dashboard.members.edit');

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
