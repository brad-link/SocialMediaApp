<?php

use App\Http\Controllers\PostController;
use App\Livewire\Followers;
use App\Livewire\Following;
use App\Livewire\Follows;
use App\Livewire\Profile;
use App\Livewire\ShowPosts;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

// Route::view('/', 'welcome');
// Route::get('/', [PostController::class, 'index']);
Route::get('/dashboard', ShowPosts::class)
    ->middleware(['auth'])
    ->name('posts');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/followers', Followers::class)
    ->middleware(['auth'])
    ->name('followers.index');

Route::get('/following', Following::class)
    ->middleware(['auth'])
    ->name('following.index');

Route::get('/profile/{id}', Profile::class)
    ->middleware(['auth'])
    ->name('profile.view');
