<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index()
    {
        // TODO: GET /api/texts
    }

    public function store(Request $request)
    {
        // TODO: POST /api/texts
    }

    public function show($id)
    {
        // TODO: GET /api/texts/{id}
    }

    public function update(Request $request, $id)
    {
        // TODO: PUT /api/texts/{id}
    }

    public function destroy($id)
    {
        // TODO: DELETE /api/texts/{id}
    }

    public function translate(Request $request)
    {
        // TODO: POST /api/texts/translate (DeepL)
    }

    public function generate(Request $request)
    {
        // TODO: POST /api/texts/generate (AI story)
    }
}
