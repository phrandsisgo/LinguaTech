<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'name'  => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
        ]);
        $user->update($request->only('name', 'email'));
        return response()->json($user);
    }

    public function addLanguage(Request $request)
    {
        $request->validate(['lang_option_id' => 'required|integer']);
        Auth::user()->languages()->syncWithoutDetaching([$request->lang_option_id]);
        return response()->json(['message' => 'Language added']);
    }

    public function removeLanguage($id)
    {
        Auth::user()->languages()->detach($id);
        return response()->json(['message' => 'Language removed']);
    }

    public function updateInterests(Request $request)
    {
        $request->validate(['interests' => 'nullable|array']);
        Auth::user()->interests()->sync($request->interests ?? []);
        return response()->json(['message' => 'Interests updated']);
    }

    public function subscriptionStatus()
    {
        $user = Auth::user();
        return response()->json([
            'subscribed_until' => $user->subscribed_until,
            'is_active'        => $user->subscribed_until && \Carbon\Carbon::parse($user->subscribed_until)->isFuture(),
        ]);
    }
}
