<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    
    
    public function handle(Request $request, Closure $next): Response
    {
   
        if (!Auth::guard('admin')->check()) {

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized. Please login as admin first.'
                ], 401);
            }

            return redirect()->route('admin.login')->with('error', 'Please login as admin first.');
        }

        return $next($request);
    }
}
