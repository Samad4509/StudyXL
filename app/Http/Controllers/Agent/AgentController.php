<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AgentResetPassword;

class AgentController extends Controller
{

    public function store(Request $request)
    {


        // return $request;
        // 🔁 Manually decode JSON content
        $data = json_decode($request->getContent(), true);

        // 🛑 Check if email already exists
        if (Agent::where('email', $data['email'])->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'This email address is already registered.'
            ], 409); // Conflict
        }



        // ✅ Create agent with all the fields
        $agent = Agent::create([
            'prefix' => $data['prefix'] ?? null,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'company_name' => $data['company_name'] ?? null,
            'job_title' => $data['job_title'] ?? null,
            'country_dialing_code' => $data['country_dialing_code'] ?? null,
            'phone_number' => $data['phone_number'] ?? null,
            'email' => $data['email'] ?? null,
            'finance_email' => $data['finance_email'] ?? null,
            'password' => isset($data['password']) ? bcrypt($data['password']) : null,
            'street_address' => $data['street_address'] ?? null,
            'street_address_line2' => $data['street_address_line2'] ?? null,
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'postal_code' => $data['postal_code'] ?? null,
            'country' => $data['country'] ?? null,
            'director_prefix' => $data['director_prefix'] ?? null,
            'director_first_name' => $data['director_first_name'] ?? null,
            'director_last_name' => $data['director_last_name'] ?? null,
            'director_job_title' => $data['director_job_title'] ?? null,
            'director_dialing_code' => $data['director_dialing_code'] ?? null,
            'director_phone_number' => $data['director_phone_number'] ?? null,
            'director_email' => $data['director_email'] ?? null,
            'trading_name' => $data['trading_name'] ?? null,
            'website' => $data['website'] ?? null,
            'students_per_year' => $data['students_per_year'] ?? null,
            'destinations' => isset($data['destinations']) ? json_encode($data['destinations']) : null,
            'other_destination' => $data['other_destination'] ?? null,
            'litigation' => $data['litigation'] ?? null,
            'litigation_details' => $data['litigation_details'] ?? null,
            'australia_recruitment' => $data['australia_recruitment'] ?? null,
            'australia_recruitment_details' => $data['australia_recruitment_details'] ?? null,
            'institutions' => $data['institutions'] ?? null,
            'college' => $data['college'] ?? false,
            'creative_course' => $data['creative_course'] ?? false,
            'university_preparation' => $data['university_preparation'] ?? false,
            'adult_english' => $data['adult_english'] ?? false,
            'junior_english' => $data['junior_english'] ?? false,
            'direct_entry' => $data['direct_entry'] ?? false,
            'year_established' => $data['year_established'] ?? null,
            'branch_offices' => $data['branch_offices'] ?? null,
            'counsellors' => $data['counsellors'] ?? null,
            'icef_id' => $data['icef_id'] ?? null,
            'hear_about' => $data['hear_about'] ?? null,
            'why_oxford' => $data['why_oxford'] ?? null,
            'referee_prefix' => $data['referee_prefix'] ?? null,
            'referee_first_name' => $data['referee_first_name'] ?? null,
            'referee_last_name' => $data['referee_last_name'] ?? null,
            'referee_company' => $data['referee_company'] ?? null,
            'referee_email' => $data['referee_email'] ?? null,
            'referee_dialing_code' => $data['referee_dialing_code'] ?? null,
            'referee_phone' => $data['referee_phone'] ?? null,
            'referee_website' => $data['referee_website'] ?? null,
            'is_approved' => $data['is_approved'] ?? false,
            'status' => $data['status'] ?? 'inactive'
        ]);

        // ✅ Success response
        return response()->json([
            'status' => true,
            'message' => 'Agent registered successfully.',
            'agent' => $agent
        ], 201); // 201 Created
    }


    public function forget_password_submit(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $agent = Agent::where('email', $request->email)->first();
        if (!$agent) {
            return response()->json(['status' => false, 'message' => 'Email not found.'], 404);
        }

        // Generate secure token
        $token = hash('sha256', time() . $agent->email);
        $agent->token = $token;
        $agent->save();

        // Send notification
        $agent->notify(new AgentResetPassword($token));

        return response()->json([
            'status' => true,
            'message' => 'Please check your email for the password reset link.'
        ]);
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $agent = Agent::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$agent) {
            return response()->json(['status' => false, 'message' => 'Invalid token or email.'], 400);
        }

        // Update password and clear token
        $agent->password = Hash::make($request->password);
        $agent->token = null;
        $agent->save();

        return response()->json(['status' => true, 'message' => 'Password reset successfully.']);
    }
}
