<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clear(Request $request)
    {
        // 🔹 Clear individual caches
        Artisan::call('cache:clear');      // application cache
        Artisan::call('config:clear');     // config cache
        Artisan::call('route:clear');      // route cache
        Artisan::call('view:clear');       // view cache

        // 🔹 Optional: Optimize
        Artisan::call('optimize:clear');   // সব cache একসাথে safe

        return response()->json([
            'status' => 'success',
            'message' => 'All Artisan caches cleared successfully'
        ]);
    }
}
