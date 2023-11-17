<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/swipeTest', function () {
    return view('swipeTest');
});
Route::get('/home_logged', function () {
    return view('home_logged');
});
Route::get('/about_project', function () {
    return view('about_project');
});
Route::get('/library', function () {
    return view('library');
});
Route::get('/list_show', function () {
    return view('list_show');
});
Route::get('/list_create', function () {
    return view('list_create');
});
Route::get('/swipePlay', function () {
    return view('swipePlay');
});
Route::get('/playground', function () {
    return view('playground');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
