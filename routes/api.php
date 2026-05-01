<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WordListController;
use App\Http\Controllers\Api\TextController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\TranslateController;
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

// Auth Routes (public)
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

// Auth Routes (protected)
Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

// Languages (public)
Route::get('/languages', [LanguageController::class, 'index']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // WordLists / Library
    Route::get('/wordlists', [WordListController::class, 'index']);
    Route::post('/wordlists', [WordListController::class, 'store']);
    Route::get('/wordlists/{id}', [WordListController::class, 'show']);
    Route::put('/wordlists/{id}', [WordListController::class, 'update']);
    Route::delete('/wordlists/{id}', [WordListController::class, 'destroy']);
    Route::post('/wordlists/{id}/copy', [WordListController::class, 'copy']);
    Route::post('/wordlists/{id}/words', [WordListController::class, 'addWord']);
    Route::delete('/words/{id}', [WordListController::class, 'deleteWord']);
    Route::post('/swipe', [WordListController::class, 'swipeHandle']);

    // Texts
    Route::get('/texts', [TextController::class, 'index']);
    Route::post('/texts/generate', [TextController::class, 'generate']);
    Route::get('/texts/{id}', [TextController::class, 'show']);
    Route::post('/texts', [TextController::class, 'store']);
    Route::put('/texts/{id}', [TextController::class, 'update']);
    Route::delete('/texts/{id}', [TextController::class, 'destroy']);

    // Profile
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    Route::post('/profile/interests', [ProfileController::class, 'updateInterests']);
    Route::post('/profile/languages', [ProfileController::class, 'addLanguage']);
    Route::delete('/profile/languages/{id}', [ProfileController::class, 'removeLanguage']);
    Route::post('/profile/cancel-subscription', [ProfileController::class, 'cancelSubscription']);
    Route::post('/profile/initiate', [ProfileController::class, 'initiate']);

    // Misc
    Route::post('/translate', [TranslateController::class, 'translate']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/patch-notes', [\App\Http\Controllers\Api\PatchNotesController::class, 'index']);
    Route::get('/patch-notes/{id}', [\App\Http\Controllers\Api\PatchNotesController::class, 'show']);
});
