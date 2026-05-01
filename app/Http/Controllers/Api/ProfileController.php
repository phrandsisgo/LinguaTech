<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        // TODO: GET /api/profile
    }

    public function update(Request $request)
    {
        // TODO: PUT /api/profile
    }

    public function destroy(Request $request)
    {
        // TODO: DELETE /api/profile
    }

    public function updateInterests(Request $request)
    {
        // TODO: POST /api/profile/interests
    }

    public function addLanguage(Request $request)
    {
        // TODO: POST /api/profile/languages
    }

    public function removeLanguage(Request $request, $id)
    {
        // TODO: DELETE /api/profile/languages/{id}
    }

    public function cancelSubscription(Request $request)
    {
        // TODO: POST /api/profile/cancel-subscription
    }

    public function initiateShow(Request $request)
    {
        // TODO: GET /api/initiate-profile
    }

    public function initiateStore(Request $request)
    {
        // TODO: POST /api/initiate-profile
    }

    public function addLanguageInitiate(Request $request)
    {
        // TODO: POST /api/initiate-profile/languages
    }

    public function removeLanguageInitiate(Request $request, $id)
    {
        // TODO: DELETE /api/initiate-profile/languages/{id}
    }
}
