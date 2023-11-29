<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReleaseNote;
use App\Models\ReleaseNotesComment;


class PatchNotesController extends Controller{
    
    public function showPatch($id){
        $patch = ReleaseNote::with('comments')->find($id);
        return view('patchNotes/patch_show',['patch' => $patch]);
    }

    public function releaseNotesComment(Request $request, $id){
       
        $request->validate([
            'comment' => 'required|min:5|max:200',
        ]);

        ReleaseNotesComment::create([
            'comment' => $request->comment,
            'release_note_id' => $id,
            'user_id' => auth()->user()->id,
        ]);
        dd(auth()->user()->id);
        return redirect()->route('showPatch', ['id' => $id]);
    }
}
