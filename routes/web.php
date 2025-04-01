<?php


use App\Livewire\UserAdmin;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::redirect('/login', '/auth/login')->name('login');
Route::redirect('/logout', '/auth/logout')->name('logout');


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/', \App\Livewire\CallJournalComp::class);
    Route::get('/sms', \App\Livewire\SendSMS::class);
    Route::get('/note', \App\Livewire\TelNoteList::class);
    Route::get('/note/new', \App\Livewire\TelNoteCreate::class);
    Route::get('/journal', \App\Livewire\CallJournalComp::class);
    Route::get('/settings', \App\Livewire\UserSettingsComponent::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', \App\Livewire\Admin\UserList::class);
    Route::get('/users/roles', \App\Livewire\Admin\Roles::class);
    Route::get('/users/roles/permissions', \App\Livewire\Admin\Permissions::class);
});



