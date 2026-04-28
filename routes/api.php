<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\WordListController;
use App\Http\Controllers\API\SwipeController;
use App\Http\Controllers\API\TextController;
use App\Http\Controllers\API\ProfileController;

/*
|--------------------------------------------------------------------------
| LinguaTech API Routes
|--------------------------------------------------------------------------
|
| All routes return JSON. No HTML views here.
| Authentication: Bearer Token via Laravel Sanctum.
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Word Lists (Library)
    Route::get('/lists', [WordListController::class, 'index']);              // Alle Listen
    Route::get('/lists/own', [WordListController::class, 'own']);             // Eigene Listen
    Route::get('/lists/subscribed', [WordListController::class, 'subscribed']); // Abonnierte Listen
    Route::get('/lists/{id}', [WordListController::class, 'show']);          // Einzelne Liste mit Wörtern
    Route::post('/lists', [WordListController::class, 'store']);              // Neue Liste erstellen
    Route::put('/lists/{id}', [WordListController::class, 'update']);         // Liste bearbeiten
    Route::delete('/lists/{id}', [WordListController::class, 'destroy']);      // Liste löschen
    Route::post('/lists/{id}/copy', [WordListController::class, 'copy']);     // Liste kopieren
    Route::post('/lists/{id}/subscribe', [WordListController::class, 'subscribe']); // Liste abonnieren

    // Words inside lists
    Route::post('/lists/{id}/words', [WordListController::class, 'addWord']);  // Wort hinzufügen
    Route::delete('/words/{id}', [WordListController::class, 'deleteWord']);  // Wort löschen
    Route::post('/words/{id}/priority', [WordListController::class, 'updatePriority']); // Priorität ändern

    // SRS / Swipe Learning
    Route::get('/lists/{id}/due-words', [SwipeController::class, 'dueWords']);  // Fällige Wörter für Session
    Route::post('/swipe', [SwipeController::class, 'handle']);                // Swipe verarbeiten (SM-2)
    Route::post('/swipe/undo', [SwipeController::class, 'undo']);              // Letzten Swipe rückgängig

    // Texts (AI-Generated)
    Route::get('/texts', [TextController::class, 'index']);                      // Alle Texte
    Route::get('/texts/{id}', [TextController::class, 'show']);                // Einzelner Text
    Route::post('/texts', [TextController::class, 'store']);                   // Text manuell erstellen
    Route::post('/texts/generate', [TextController::class, 'generate']);        // Text mit AI generieren
    Route::put('/texts/{id}', [TextController::class, 'update']);              // Text bearbeiten
    Route::delete('/texts/{id}', [TextController::class, 'destroy']);         // Text löschen

    // Translation (DeepL)
    Route::post('/translate', [TextController::class, 'translate']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/languages', [ProfileController::class, 'addLanguage']);
    Route::delete('/profile/languages/{id}', [ProfileController::class, 'removeLanguage']);
    Route::post('/profile/interests', [ProfileController::class, 'updateInterests']);

    // Stripe / Subscription (Stub)
    Route::get('/subscription/status', [ProfileController::class, 'subscriptionStatus']);
});
