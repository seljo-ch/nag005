<?php


use App\Livewire\UserAdmin;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Welcome::class);
Route::get('/users', \App\Livewire\UserAdmin::class);
Route::get('/users/{id}/edit', UserAdmin::class)->name('editUser');

Route::get('/sms', \App\Livewire\SendSMS::class);

