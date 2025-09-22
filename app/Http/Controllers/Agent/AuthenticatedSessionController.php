<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Display the login page for the agent
        return view('agent.auth.login');
    }

    /**
     * Handle an incoming login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'  // added password length check
        ]);

        // Get credentials from the request
        $credentials = $request->only('email', 'password');

        if (Auth::guard('agent')->attempt($credentials)) {
            $agent = Auth::guard('agent')->user();

            if (!$agent->is_approved || $agent->status !== 'active') {
                Auth::guard('agent')->logout();

                return response()->json([
                    'status' => false,
                    'message' => 'Your account is pending approval or has been deactivated. Please contact admin support.'
                ], 403);
            }

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'agent' => $agent
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid email or password'
        ], 401);
    }
}
