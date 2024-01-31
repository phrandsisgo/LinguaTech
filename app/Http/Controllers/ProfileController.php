<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\WordListWord;
use Illuminate\View\View;
use App\Models\Interest;
use App\Models\LangOption;
use App\Models\WordList;
use App\Models\User;
use App\Models\Word;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $interests = Interest::all();
        $user = Auth::user();
        $languages = LangOption::all();
        return view('profile.edit', [
            'user' => $user,
            'interests' => $interests,
            'languages' => $languages,
        ]);
    }
    public function initiateProfile(Request $request): View
    {
        $interests = Interest::all();
        $user = Auth::user();
        $languages = LangOption::all();
        return view('profile.initiate', [
            'user' => $user,
            'interests' => $interests,
            'languages' => $languages,
        ]);
    }
    public function postInitiate(Request $request): RedirectResponse{
        $user = $request->user();
        $interests = $request->input('interests', []);
        $languages = $request->input('language', []);
        // Aktualisiert die Interessen der Benutzer
        $user->interests()->sync($interests);
        $user->languages()->sync($languages);
        //dd($user);
        return redirect('/');
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updateInterests(Request $request){
        $user = $request->user();
        $interests = $request->input('interests', []);
        // Aktualisiert die Interessen der Benutzer
        $user->interests()->sync($interests);
    
        return redirect()->back();
    }
    public function addLanguage(Request $request){
        $user = $request->user();
        $languages = $request->input('language', []);
        $user->languages()->attach($languages);
        return redirect('/profile');
    }
    public function addLanguageInitiate(Request $request){
        $user = $request->user();
        $languages = $request->input('language', []);
        $user->languages()->attach($languages);
        //dd($request->all());
        //search database for all Wordlists that have the language in it and are created from the user_id =1 and store it in a variable
        $wordlists = WordList::where('created_by', 1)->where('base_language', $languages)->orWhere('target_language', $languages)->get();
        //dd();
        //and now it has to copy the wordlists and change the user_id to the current user_id
        foreach($wordlists as $wordlist){
            $newWordlist = new WordList;
            $newWordlist->name = $wordlist->name;
            $newWordlist->description = $wordlist->description;
            $newWordlist->created_by = $user->id;
            $newWordlist->base_language = $wordlist->base_language;
            $newWordlist->target_language = $wordlist->target_language;
            $newWordlist->save();
            $newWordListId = $newWordlist->id;
            $newWordlist->created_at = now();
            $wordListWords = WordListWord::where('word_list_id', $wordlist->id)->get();
            foreach($wordListWords as $wordListWord){
                $newWordListWord = new WordListWord;
                $newWordListWord->word_list_id = $newWordListId;
                $newWordListWord->word_id = $wordListWord->word_id;
                $newWordListWord->created_at = now();
                $newWordListWord->save();
            }
        
        }
        
        return redirect('/initiateProfile');
        
    }
    public function removeLanguage(Request $request, $id){
        $user = $request->user();
        $user->languages()->detach($id);
        return redirect('/profile');
    }
    public function removeLanguageInitiate(Request $request, $id){
        $user = $request->user();
        $user->languages()->detach($id);
        return redirect('/initiateProfile');
    }

    
}
