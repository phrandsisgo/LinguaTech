<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LangOption;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(LangOption::whereBetween('id', [2, 12])->get());
    }
}
