<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordListController;
use App\Http\Controllers\PatchNotesController;
use App\Http\Controllers\LingApiController;
use App\Http\Controllers\LanguageController;

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

Route::get('/patchList', [PatchNotesController::class,'patchList'])
->name('patchList');

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
//->middleware('ensure.user:word');

Route::post('/swipeHandle', [WordListController::class, 'swipeHandle'])
->name('swipeHandle'); //middleware is missing here

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
    Route::post('/updateInterests', [ProfileController::class, 'updateInterests'])->name('updateInterests');  
    Route::post('/addLanguage', [ProfileController::class, 'addLanguage'])->name('addLanguage');  
    Route::delete('/removeLanguageInitiate/{id}', [ProfileController::class, 'removeLanguageInitiate'])->name('removeLanguageInitiate');
    Route::delete('/removeLanguage/{id}', [ProfileController::class, 'removeLanguage'])->name('removeLanguage');
    Route::get('/initiateProfile', [ProfileController::class, 'initiateProfile'])->name('initiateProfile');
    Route::post('/initiateProfile', [ProfileController::class, 'postInitiate'])->name('postInitiate');
    Route::post('addLanguageInitiate', [ProfileController::class, 'addLanguageInitiate'])->name('addLanguageInitiate');
    Route::post('/copyList/{listId}', [WordListController::class, 'copyList'])->name('copyList');
});
//die liste der Middlewares mit den Zuweisungen findet man unter app/Http/Kernel.php

Route::get('/addText', [LingApiController::class, 'addText'])->name('addText');
Route::post('/createNewText', [LingApiController::class, 'createNewText'])->name('createNewText');
//hier fangen die routen an für die API sachen:

Route::get('/textPlay', [LingApiController::class, 'textPlay'])
->middleware('auth');

Route::get('/textShow/{id}', [LingApiController::class, 'textShow'])
->name('textShow')->middleware('auth');

Route::get('/displayAllTexts', [LingApiController::class, 'displayAllTexts'])
->name('displayAllTexts')->middleware('auth');

Route::post('/translate', [LingApiController::class, 'translate'])
->name('translate');
//Rout to change the UI language of the app
Route::get('/language/{lang}',[LanguageController::class, 'changeLanguage'])
    ->middleware('SetLanguageMiddleware')
    ->name('language.change');


require __DIR__.'/auth.php';
