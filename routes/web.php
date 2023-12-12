<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordListController;
use App\Http\Controllers\PatchNotesController;
use App\Http\Controllers\LingApiController;

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

Route::get('/spielwiese', function () {
    return view('patchNotes/spielwiese');
});

Route::get('/swipeTest', function () {
    return view('swipeTest');
});
Route::get('/about_me', function () {
    return view('about_me');
});
Route::get('/about_project', function () {
    return view('about_project');
})->name('about_project');

Route::get('/library',[WordListController::class,'library'])
->middleware('auth')
->name('library');

Route::get('/swipeLearn/{id}',[WordListController::class,'swipeLearn'])
->middleware('auth')
->name('swipeLearn');

Route::get('/list_show/{id}',[WordListController::class,'listShow'])
->name('list_show');

Route::get('/list_update/{id}', [WordListController::class,'listLoad'])
//->middleware('checkListAuthor')
->name('list_load');

Route::get('/showPatch/{id}', [PatchNotesController::class,'showPatch'])
->name('showPatch');

Route::post('/releaseNotesComment/{id}', [PatchNotesController::class,'releaseNotesComment'])
->name('releaseNotesComment');

Route::post('/releaseNotesCommentDelete/{id}', [PatchNotesController::class,'releaseNotesCommentDelete'])
->name('releaseNotesCommentDelete');

Route::post('/list_update_function/{id}', [WordListController::class, 'list_update_function'])
//->middleware('checkListAuthor')
->name('list_update_function');//middleware is missing here

Route::post('/list_add_word', [WordListController::class, 'list_add_word'])
->name('list_add_word');//middleware is missing here

Route::post('/list_create_function', [WordListController::class, 'list_create_function'])
->name('list_create_function');//middleware is missing here

Route::post('/list_delete_function/{id}', [WordListController::class, 'list_delete_function'])
->name('list_delete_function');//middleware is missing here

Route::post('/word_delete_function/{id}/{listId}', [WordListController::class, 'word_delete_function'])
->name('word_delete_function');//middleware is missing here

Route::get('/list_create', function () {
    return view('list_create');
});


Route::get('/swipePlay', function () {
    return view('swipePlay');
})->middleware('auth');
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
//die liste der Middlewares mit den Zuweisungen findet man unter app/Http/Kernel.php


//hier fangen die routen an für die API sachen:
/* //diese route kann gelöscht werden
Route::get('/textPlay', function () {
    return view('api-stuff/textPlay');
})->middleware('auth');
 */
Route::get('/textPlay', [LingApiController::class, 'textPlay'])
->middleware('auth');

Route::post('/translate', [LingApiController::class, 'translate'])
->name('translate');

require __DIR__.'/auth.php';
