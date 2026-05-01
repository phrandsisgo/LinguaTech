<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // TODO: Register user, create token, return user + token
    }

    public function login(Request $request)
    {
        // TODO: Validate credentials, create token, return user + token
    }

    public function logout(Request $request)
    {
        // TODO: Revoke current token
    }

    public function forgotPassword(Request $request)
    {
        // TODO: Send password reset link
    }

    public function resetPassword(Request $request)
    {
        // TODO: Reset password with token
    }

    public function sendVerificationEmail(Request $request)
    {
        // TODO: Resend email verification link
    }
}
