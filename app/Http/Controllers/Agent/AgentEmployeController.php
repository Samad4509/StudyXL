<?php

namespace App\Http\Controllers\Agent;


use Illuminate\Http\Request;
use App\Models\AgentEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AgentEmployeController extends Controller
{
     // ✅ Employee login
   public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string'
    ]);

    $employee = AgentEmployee::where('email', $request->email)->first();

    if (!$employee || !Hash::check($request->password, $employee->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Create token
    $token = $employee->createToken('EmployeeToken')->plainTextToken;

    // Get roles and permissions
    $roles = $employee->getRoleNames(); // Returns a collection of roles
    $permissions = $employee->getAllPermissions()->pluck('name'); // Returns all permission names

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'employee' => [
            'id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
            'roles' => $roles,
            'permissions' => $permissions,
        ],
    ]);
}


    // ✅ Employee create by Agent
//    public function createEmployee(Request $request)
//     {
//         // 🔹 Authenticated agent
      
//         $agent = Auth::guard('agent_token')->user();

//         if (!$agent) {
//             return response()->json([
//                 'message' => 'Unauthenticated.'
//             ], 401);
//         }

//         // 🔹 Validate request
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:agent_employees,email',
//             'password' => 'required|string|min:4',
//             'permissions' => 'required|array' // ['application.create','task.update',...]
//         ]);

//         // 🔹 Create employee
//         $employee = AgentEmployee::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'agent_id' => $agent->id,
//             'is_active' => true
//         ]);

//         // 🔹 Assign only Agent's own permissions
//         $permissions = Permission::where('agent_id', $agent->id)
//                                  ->whereIn('name', $request->permissions)
//                                  ->get();

//         $employee->syncPermissions($permissions);

//         return response()->json([
//             'message' => 'Employee created successfully',
//             'employee' => $employee,
//             'permissions' => $permissions
//         ]);
//     }

    public function createEmployee(Request $request)
    {
        $agent = Auth::guard('agent_token')->user();

        if (!$agent) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agent_employees,email',
            'password' => 'required|string|min:4',
            'permissions' => 'required|array'
        ]);

        $employee = AgentEmployee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'agent_id' => $agent->id,
            'is_active' => true
        ]);

        // Get agent's permissions
        $agentPermissions = $agent->getAllPermissions()->pluck('name')->toArray();

        // Only assign permissions that the agent has
        $assignPermissions = array_intersect($agentPermissions, $request->permissions);

        $permissions = Permission::whereIn('name', $assignPermissions)
                                ->where('guard_name', 'agent')
                                ->get();

        $employee->syncPermissions($permissions);

        return response()->json([
            'status' => true,
            'message' => 'Employee created successfully',
            'employee' => $employee,
            'permissions' => $assignPermissions
        ]);
    }



    // ✅ Get all Employees of this Agent
    public function allEmployees(Request $request)
    {
        $agent = $request->user();
        $employees = AgentEmployee::where('agent_id', $agent->id)->get();

        return response()->json($employees);
    }
}
