<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\EmailVerificationRequest;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmailVerificationRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->hasVerifiedEmail()) return redirect('/login');
        
        $user->sendEmailVerificationNotification();

        return redirect('/login');
    }
}
