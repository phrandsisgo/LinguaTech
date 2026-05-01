<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Text;
use App\Models\WordList;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $userId = auth()->id();

        $decks = WordList::where('created_by', $userId)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        $texts = Text::where('created_by', $userId)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        return response()->json(compact('decks', 'texts'));
    }
}
