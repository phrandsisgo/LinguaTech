<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReleaseNote;


class PatchNotesController extends Controller{
    public function showPatch($id){
        $patch = ReleaseNote::with('comments')->find($id);
        return view('patchNotes/patch_show',['patch' => $patch]);
    }
}
