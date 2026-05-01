<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\LangOption;
use App\Models\WordList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return response()->json($user);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }

    public function updateInterests(Request $request): JsonResponse
    {
        $request->validate([
            'interests' => ['required', 'array'],
        ]);

        $user = $request->user();
        $user->interests()->sync($request->interests);

        return response()->json($user->interests);
    }

    public function addLanguage(Request $request): JsonResponse
    {
        $request->validate([
            'language' => ['required'],
        ]);

        $user = $request->user();
        $user->languages()->attach($request->language);

        return response()->json($user->languages);
    }

    public function removeLanguage(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        $user->languages()->detach($id);

        return response()->json($user->languages);
    }

    public function cancelSubscription(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user->stripe_subscription_id) {
            return response()->json(['error' => 'Du hast kein aktives Abonnement.'], 422);
        }

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

            $subscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);
            $subscription->cancel();

            $user->subscription_status = 'canceled';
            $user->save();

            return response()->json(['message' => 'Dein Abonnement wurde gekündigt.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fehler bei der Kündigung: ' . $e->getMessage()], 500);
        }
    }

    public function initiate(Request $request): JsonResponse
    {
        $request->validate([
            'interests' => ['nullable', 'array'],
            'languages' => ['nullable', 'array'],
        ]);

        $user = $request->user();
        $interests = $request->input('interests', []);
        $languages = $request->input('languages', []);

        $user->interests()->sync($interests);
        $user->languages()->sync($languages);

        if (!empty($languages)) {
            $wordlists = WordList::where('created_by', 1)
                ->where(function ($query) use ($languages) {
                    $query->whereIn('base_language', $languages)
                        ->orWhereIn('target_language', $languages);
                })
                ->get();

            foreach ($wordlists as $wordlist) {
                $newWordlist = $wordlist->replicate(['created_by', 'created_at', 'updated_at']);
                $newWordlist->created_by = $user->id;
                $newWordlist->save();

                foreach ($wordlist->words as $word) {
                    $newWord = $word->replicate();
                    $newWord->word_list_id = $newWordlist->id;
                    $newWord->save();
                }
            }
        }

        return response()->json(['message' => 'Profile initiated successfully']);
    }
}
