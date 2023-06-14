<?php

use Livewire\Livewire;
use App\Http\Livewire\PostsSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DashboardSearch;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;

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

// Auth
Auth::routes();

// Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Dashboard
Livewire::component('search.dashboard', DashboardSearch::class);

// Posts
Livewire::component('search.posts', PostsSearch::class);
Route::resource('posts', PostsController::class)->names('posts');

// User Profile
Route::resource('profiles', ProfilesController::class)->only(['show', 'edit', 'update'])->names('profiles');

// Tags
Route::get('/search-tags', [TagsController::class, 'search'])->name('tags.search');