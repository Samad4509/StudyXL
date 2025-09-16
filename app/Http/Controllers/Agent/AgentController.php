<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => "required|string|max:100",
            "last_name" => "required|string|max:100",
            "company_name" => "required|string|max:200",
            "job_title" => "required|string|max:150",
            "email" => "required|email|unique:agents,email",
            "finance_email" => "required|email",
            "password" => "required|min:6",
            "phone_number" => "required",
            "country_dialing_code" => "nullable|string|max:10",
            "street_address" => "required",
            "city" => "required",
            "country" => "required",
        ]);

        // Automatically prepend +880 if not already included
        if (!str_starts_with($validated['phone_number'], '+880')) {
            $validated['phone_number'] = '+880' . ltrim($validated['phone_number'], '0');
        }
        
        $validated["password"] = Hash::make($validated["password"]);
        $validated["destinations"] = json_encode($request->destinations);

        $agent = Agent::create($validated);

        return response()->json([
            "status" => true,
            "message" => "Agent registered successfully",
            "data" => $agent
        ]);
    }
}
