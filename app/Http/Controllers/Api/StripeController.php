<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function config()
    {
        // TODO: GET /api/stripe/config (publishable key)
    }

    public function checkout(Request $request)
    {
        // TODO: POST /api/stripe/checkout (create session)
    }

    public function success(Request $request)
    {
        // TODO: GET /api/stripe/success
    }

    public function cancel(Request $request)
    {
        // TODO: GET /api/stripe/cancel
    }
}
