<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Auth.forgot-password');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForgotPasswordRequest $request)
    {
        $validated = $request->validated();

        $status = Password::sendResetLink(
            $validated
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
