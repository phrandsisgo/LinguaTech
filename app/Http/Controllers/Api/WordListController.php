<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WordListController extends Controller
{
    public function index(): JsonResponse
    {
        $wordlists = WordList::where('created_by', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json($wordlists);
    }

    public function show(int $id): JsonResponse
    {
        $liste = WordList::with('words')->findOrFail($id);

        return response()->json($liste);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'listTitle' => 'required|min:3|max:40',
            'baseWord' => 'sometimes|array',
            'baseWord.*' => 'required|min:1|max:50',
            'targetWord' => 'sometimes|array',
            'targetWord.*' => 'required|min:1|max:50',
            'listDescription' => 'nullable|max:200',
        ]);

        $liste = new WordList();
        $liste->name = $request->listTitle;
        $liste->description = $request->listDescription;
        $liste->created_by = auth()->id();
        $liste->save();

        if ($request->has('baseWord') && is_array($request->baseWord)) {
            foreach ($request->baseWord as $index => $baseWord) {
                $word = new Word();
                $word->base_word = $baseWord;
                $word->target_word = $request->targetWord[$index];
                $word->base_language_id = 1;
                $word->target_language_id = 2;
                $word->word_list_id = $liste->id;
                $word->save();
            }
        }

        return response()->json(WordList::with('words')->find($liste->id), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'listTitle' => 'required|min:3|max:20',
            'baseWord' => 'sometimes|array',
            'baseWord.*' => 'required|min:1|max:50',
            'targetWord' => 'sometimes|array',
            'targetWord.*' => 'required|min:1|max:50',
            'listDescription' => 'nullable|max:200',
        ]);

        $liste = WordList::findOrFail($id);
        $baseWords = $request->baseWord ?? [];
        $targetWords = $request->targetWord ?? [];
        $wordIds = $request->wordIds ?? [];
        $deletedWordIds = $request->deletedWordIds ?? [];

        foreach ($deletedWordIds as $wordId) {
            $word = Word::find($wordId);
            if ($word) {
                $word->delete();
            }
        }

        foreach ($wordIds as $index => $wordId) {
            if ($wordId === 'new') {
                $word = new Word();
                $word->base_word = $baseWords[$index];
                $word->target_word = $targetWords[$index];
                $word->base_language_id = 1;
                $word->target_language_id = 2;
                $word->word_list_id = $liste->id;
                $word->save();
            } else {
                $word = Word::find($wordId);
                if ($word) {
                    $word->base_word = $baseWords[$index];
                    $word->target_word = $targetWords[$index];
                    $word->save();
                }
            }
        }

        $liste->name = $request->listTitle;
        $liste->description = $request->listDescription;
        $liste->save();

        return response()->json(WordList::with('words')->find($liste->id));
    }

    public function destroy(int $id): JsonResponse
    {
        $liste = WordList::findOrFail($id);

        foreach ($liste->words as $word) {
            $word->delete();
        }

        $liste->delete();

        return response()->json(['message' => 'WordList deleted successfully']);
    }

    public function copy(int $id): JsonResponse
    {
        $liste = WordList::with('words')->findOrFail($id);

        $newList = $liste->replicate();
        $newList->created_by = auth()->id();
        $newList->created_at = now();
        $newList->updated_at = now();
        $newList->save();

        foreach ($liste->words as $word) {
            $newWord = $word->replicate();
            $newWord->word_list_id = $newList->id;
            $newWord->created_at = now();
            $newWord->updated_at = now();
            $newWord->save();
        }

        return response()->json(WordList::with('words')->find($newList->id), 201);
    }

    public function addWord(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'baseWord' => 'required|min:1|max:50',
            'targetWord' => 'required|min:1|max:50',
        ]);

        $word = new Word();
        $word->base_word = $request->targetWord;
        $word->target_word = $request->baseWord;
        $word->base_language_id = 1;
        $word->target_language_id = 2;
        $word->word_list_id = $id;
        $word->save();

        return response()->json($word, 201);
    }

    public function deleteWord(int $id): JsonResponse
    {
        $word = Word::findOrFail($id);
        $word->delete();

        return response()->json(['message' => 'Word deleted successfully']);
    }

    public function swipeHandle(Request $request): JsonResponse
    {
        $request->validate([
            'wordId' => 'required',
            'direction' => 'required|in:left,right',
        ]);

        $word = Word::findOrFail($request->wordId);

        if ($request->direction === 'left') {
            $word->decreaseCountForAuthUser(1);
        } else {
            $word->increaseCountForAuthUser(1);
        }

        return response()->json([
            'success' => true,
            'count' => $word->count(),
            'wordId' => $word->id,
        ]);
    }
}
