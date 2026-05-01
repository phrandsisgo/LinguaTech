<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReleaseNote;
use Illuminate\Http\JsonResponse;

class PatchNotesController extends Controller
{
    public function index(): JsonResponse
    {
        $patches = ReleaseNote::orderBy('updated_at', 'desc')->get();

        return response()->json($patches);
    }

    public function show(int $id): JsonResponse
    {
        $patch = ReleaseNote::with('comments')->findOrFail($id);

        return response()->json($patch);
    }
}
