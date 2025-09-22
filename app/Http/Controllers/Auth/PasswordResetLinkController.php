<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($request->only('email'));

<<<<<<< HEAD
    //     // We will send the password reset link to this user. Once we have attempted
    //     // to send the link, we will examine the response then see the message we
    //     // need to show to the user. Finally, we'll send out a proper response.
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status == Password::RESET_LINK_SENT
    //                 ? back()->with('status', __($status))
    //                 : back()->withInput($request->only('email'))
    //                         ->withErrors(['email' => __($status)]);
    // }
        public function store(Request $request)
        {
            // return $request;
            // Validate the email
            $request->validate([
                'email' => ['required', 'email'],
=======
        if ($status == Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Check your inbox! Password reset link sent.'
>>>>>>> 6a5111ef1a4c5c7e023e98f4cd3e88ac1df46aa3
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __($status)
        ], 422);
    }
}
