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
        // return $request;
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        // Get credentials from the request
        $credentials = $request->only('email', 'password');

        // Attempt login using the agent guard
        if (Auth::guard('agent')->attempt($credentials)) {
            $agent = Auth::guard('agent')->user();

            // Log agent login attempt
            Log::info('Agent login attempt', ['agent_id' => $agent->id, 'email' => $agent->email]);

            // Check if the agent is approved and active
            if (!$agent->is_approved || $agent->status !== 'active') {
                Auth::guard('agent')->logout(); 

                return response()->json([
                    'status' => false,
                    'message' => 'Your account is pending approval or has been deactivated. Please contact admin support.'
                ], 403); // Forbidden
            }

            // 🔹 Generate Sanctum token for agent
            $token = $agent->createToken('AgentAPIToken')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'agent'   => $agent,
                'token'   => $token   // return token to frontend
            ], 200);
        }

        // Invalid credentials
        return response()->json([
            'status' => false,
            'message' => 'Invalid email or password'
        ], 401); // Unauthorized
    }

}
