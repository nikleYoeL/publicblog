<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function showNotice()
    {
         return view('Auth.verify-email');
    }

    public function sendNewLink(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Ссылка для подтверждения отправлена!');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('profile.show', $request->user());
    }
}
