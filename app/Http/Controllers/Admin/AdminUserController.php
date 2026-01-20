<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminUserController extends Controller
{
    // Create Sub-User with all permissions (or selected permissions)
   public function createSubUser(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|string|min:4',
        'permissions' => 'nullable|array', // optional array
        'permissions.*' => 'string|exists:permissions,name'
    ]);

    // 1️⃣ Create Sub-User
    $subAdmin = Admin::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // 2️⃣ Assign role
    $subAdmin->assignRole('admin-user');

    // 3️⃣ Assign only requested permissions
    if (!empty($request->permissions)) {
        // Loop through permission names
        foreach ($request->permissions as $permName) {
            $permission = Permission::where('name', $permName)
                                    ->where('guard_name', 'admin')
                                    ->first();
            if ($permission) {
                $subAdmin->givePermissionTo($permission);
            }
        }
    }

    return response()->json([
        'message' => 'Sub-User created successfully',
        'data' => $subAdmin->load('permissions') // only assigned permissions
    ]);
}


    // Admin Login to get Sanctum token
   public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string'
    ]);

    // Find user
    $admin = Admin::where('email', $request->email)->first();

    if (!$admin || !Hash::check($request->password, $admin->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Create Sanctum token
    $token = $admin->createToken('API Token')->plainTextToken;

    // Get all permissions of this user
    $permissions = $admin->getAllPermissions()->pluck('name'); // collection of permission names

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => [
            'id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'permissions' => $permissions
        ]
    ]);
}

}
