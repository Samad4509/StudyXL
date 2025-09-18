<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Agent;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Dashboard (Protected)
    public function dashboard()
    {
        $agents = Agent::all();
        return response()->json([
            'status' => true,
            'data'   => $agents,
        ]);
    }

    // Admin Login (API)
    public function login_submit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();

            // Sanctum Token
            $token = $admin->createToken('AdminAPIToken')->plainTextToken;

            return response()->json([
                'status'  => true,
                'message' => 'Login successful.',
                'admin'   => $admin,
                'token'   => $token,
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Invalid email or password.',
        ], 401);
    }

    // Logout (API - Sanctum)
    public function apiLogout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'status'  => true,
            'message' => 'Logged out successfully (API).',
        ]);
    }

    // Logout (Web - Session)
    public function webLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout Success');
    }

    // Forget Password (API)
    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'Email not found.'
            ], 404);
        }

        $token = hash('sha256', time());
        $admin->token = $token;
        $admin->save();

        $reset_link = url('admin/reset_password/' . $token . '/' . $request->email);

        $subject = "Reset Password";
        $message = '<a href="' . $reset_link . '">Click here to reset your password</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return response()->json([
            'status'  => true,
            'message' => 'Reset password link sent to your email.',
        ], 200);
    }

    // Reset Password Form (Web)
    public function reset_password($token, $email)
    {
        $admin = Admin::where('email', $email)->where('token', $token)->first();

        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Invalid or expired reset link');
        }

        return view('admin.reset_password', compact('email', 'token'));
    }

    // Reset Password (API)
    public function reset_password_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'              => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
            'email'                 => 'required|email',
            'token'                 => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $admin = Admin::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token or email'
            ], 400);
        }

        $admin->password = Hash::make($request->password);
        $admin->token = null;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully'
        ], 200);
    }

    // Approve Agent
    public function approveAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->is_approved = true;
        $agent->save();

        return response()->json([
            'success' => true,
            'message' => 'Agent approved successfully!',
            'agent'   => $agent
        ], 200);
    }

    // Deactivate Agent
    public function deactivateAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->status = 'inactive';
        $agent->save();

        return response()->json([
            'success' => true,
            'message' => 'Agent deactivated successfully!',
            'agent'   => $agent
        ], 200);
    }

    // Activate Agent
    public function activateAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->status = 'active';
        $agent->save();

        return response()->json([
            'success' => true,
            'message' => 'Agent activated successfully!',
            'agent'   => $agent
        ], 200);
    }

    public function alluser()
    {
        return $agent = Agent::All();
    }
}
