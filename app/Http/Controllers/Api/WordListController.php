<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WordListController extends Controller
{
    public function index()
    {
        // TODO: GET /api/word-lists
    }

    public function store(Request $request)
    {
        // TODO: POST /api/word-lists
    }

    public function show($id)
    {
        // TODO: GET /api/word-lists/{id}
    }

    public function update(Request $request, $id)
    {
        // TODO: PUT /api/word-lists/{id}
    }

    public function destroy($id)
    {
        // TODO: DELETE /api/word-lists/{id}
    }

    public function copy($id)
    {
        // TODO: POST /api/word-lists/{id}/copy
    }

    public function addWord(Request $request, $id)
    {
        // TODO: POST /api/word-lists/{id}/words
    }

    public function deleteWord($listId, $wordId)
    {
        // TODO: DELETE /api/word-lists/{listId}/words/{wordId}
    }

    public function learn($id)
    {
        // TODO: GET /api/word-lists/{id}/learn (SwipeLearn data)
    }

    public function swipeHandle(Request $request)
    {
        // TODO: POST /api/swipe
    }
}
