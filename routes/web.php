<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordListController;
use App\Http\Controllers\PatchNotesController;
use App\Http\Controllers\LingApiController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StripeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Mailgun\Mailgun;

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
}) ->name('welcome');

Route::get('/spielwiese', function () {
    return view('patchNotes/spielwiese');
});

/*Route to verify E-mail process*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.mail'); //name Wurde verändert könnte in Zukunft Probleme aufweisen

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/library');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*Route to try out the e-mail process
Route::get('/test-email', function () {
    $details = [
        "subject" => "Test-E-Mail by mailtrap",
        "body" => "This is a test e-mail sent by mailtrap."
    ];
    Mail::raw($details['body'], function ($message) use ($details) {
        $message->from('no-reply@linguatech.ch', 'Linguatech no-reply');
        $message->to('the-email@test.com');
        $message->subject($details['subject']);
    });
    return 'Test-E-Mail wurde gesendet!';
});
/*bis hierher wieder löschen sobald die Tests abgeschlossen sind */

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

Route::get('/copy_list/{id}', [WordListController::class,'copyListLoad'])
->name('copyListLoad');

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

Route::get('/playground', [LingApiController::class, 'showLandingPage'])
    ->middleware('auth')
    ->name('playground');

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
    Route::get('/home', [LingApiController::class, 'showLandingPage'])->name('home');
});
//die liste der Middlewares mit den Zuweisungen findet man unter app/Http/Kernel.php

Route::get('/addText', [LingApiController::class, 'addText'])->name('addText')->middleware('auth');
Route::post('/createNewText', [LingApiController::class, 'createNewText'])->name('createNewText')->middleware('auth');
Route::post('/deleteText', [LingApiController::class, 'destroyText'])->name('text.destroy')->middleware('auth');

//hier fangen die routen an für die API sachen:

//should not exist anymore
Route::get('/textPlay', [LingApiController::class, 'textShow'])
->middleware('auth');

Route::get('/textShow/{id}', [LingApiController::class, 'textShow'])
->name('textShow')->middleware('auth');

Route::get('/updateText/{id}', [LingApiController::class, 'updateText'])
->name('updateText')->middleware('auth');

Route::post('/updateTextFunction/{id}', [LingApiController::class, 'updateTextFunction'])
->name('updateTextFunction')->middleware('auth');

Route::get('/displayAllTexts', [LingApiController::class, 'displayAllTexts'])
->name('displayAllTexts')->middleware('auth');

//routes for the Stripe payment
Route::get('/stripe', [StripeController::class, 'index'])->
name('stripe.index');

Route::post('/checkout', [StripeController::class, 'checkout'])
    ->middleware('auth')
    ->name('checkout');

Route::get('/success', [StripeController::class, 'success'])
    ->middleware('auth')
    ->name('checkout.success');

Route::get('/cancel', [StripeController::class, 'cancel'])
    ->middleware('auth')
    ->name('checkout.cancel');

Route::get('/generate-text', [LingApiController::class, 'generateTextView'])
    ->middleware(['auth', 'Checksubscription'])
    ->name('generate-text');

Route::post('/generate-text', [LingApiController::class, 'generateText'])
    ->middleware(['auth', 'Checksubscription'])
    ->name('generate-text');

Route::post('/profile/cancel-subscription', [ProfileController::class, 'cancelSubscription'])
->name('profile.cancel-subscription');

Route::post('/translate', [LingApiController::class, 'translate'])
->name('translate')->middleware('auth');

Route::post('/profile/cancel-subscription', [ProfileController::class, 'cancelSubscription'])
->name('profile.cancel-subscription');

//Route to change the UI language of the app
Route::get('/language/{lang}',[LanguageController::class, 'changeLanguage'])
    ->middleware('SetLanguageMiddleware')
    ->name('language.change');


require __DIR__.'/auth.php';
