<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WordListController;
use App\Http\Controllers\Api\TextController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\PatchNoteController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LanguageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* ================================================================
   PUBLIC ROUTES
   ================================================================ */

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Language switch (can be public)
Route::post('/language/{lang}', [LanguageController::class, 'change']);

/* ================================================================
   AUTHENTICATED ROUTES (Sanctum)
   ================================================================ */

Route::middleware('auth:sanctum')->group(function () {

    // Current user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // Email verification
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])
        ->name('api.verification.send');

    /* ----------------- Dashboard / Home ----------------- */
    Route::get('/home', [DashboardController::class, 'home']);
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

    /* ----------------- Word Lists ----------------- */
    Route::apiResource('word-lists', WordListController::class);
    Route::post('word-lists/{id}/copy', [WordListController::class, 'copy'])->name('api.word-lists.copy');
    Route::post('word-lists/{id}/words', [WordListController::class, 'addWord'])->name('api.word-lists.add-word');
    Route::delete('word-lists/{listId}/words/{wordId}', [WordListController::class, 'deleteWord'])
        ->name('api.word-lists.delete-word');

    // Swipe / Learning
    Route::get('word-lists/{id}/learn', [WordListController::class, 'learn'])->name('api.word-lists.learn');
    Route::post('swipe', [WordListController::class, 'swipeHandle'])->name('api.swipe.handle');

    /* ----------------- Texts ----------------- */
    Route::apiResource('texts', TextController::class);
    Route::post('texts/translate', [TextController::class, 'translate'])->name('api.texts.translate');
    Route::post('texts/generate', [TextController::class, 'generate'])->name('api.texts.generate');

    /* ----------------- Profile ----------------- */
    Route::get('/profile', [ProfileController::class, 'show'])->name('api.profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('api.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('api.profile.destroy');

    Route::post('/profile/interests', [ProfileController::class, 'updateInterests'])->name('api.profile.interests');
    Route::post('/profile/languages', [ProfileController::class, 'addLanguage'])->name('api.profile.languages.add');
    Route::delete('/profile/languages/{id}', [ProfileController::class, 'removeLanguage'])->name('api.profile.languages.remove');

    Route::post('/profile/cancel-subscription', [ProfileController::class, 'cancelSubscription'])
        ->name('api.profile.cancel-subscription');

    // Profile initiation (first-time setup)
    Route::get('/initiate-profile', [ProfileController::class, 'initiateShow'])->name('api.initiate.show');
    Route::post('/initiate-profile', [ProfileController::class, 'initiateStore'])->name('api.initiate.store');
    Route::post('/initiate-profile/languages', [ProfileController::class, 'addLanguageInitiate'])
        ->name('api.initiate.languages');
    Route::delete('/initiate-profile/languages/{id}', [ProfileController::class, 'removeLanguageInitiate'])
        ->name('api.initiate.languages.remove');

    /* ----------------- Stripe / Payments ----------------- */
    Route::get('/stripe/config', [StripeController::class, 'config'])->name('api.stripe.config');
    Route::post('/stripe/checkout', [StripeController::class, 'checkout'])->name('api.stripe.checkout');
    Route::get('/stripe/success', [StripeController::class, 'success'])->name('api.stripe.success');
    Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('api.stripe.cancel');

    /* ----------------- Patch Notes ----------------- */
    Route::get('/patch-notes', [PatchNoteController::class, 'index'])->name('api.patch-notes.index');
    Route::get('/patch-notes/{id}', [PatchNoteController::class, 'show'])->name('api.patch-notes.show');

    /* ----------------- Playground ----------------- */
    Route::get('/playground', [DashboardController::class, 'playground'])->name('api.playground');
});
