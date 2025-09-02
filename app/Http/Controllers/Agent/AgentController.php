<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password; // ✅ Correct namespace

class AgentController extends Controller
{
    public function create()
    {
        return view('agent.auth.register');
    }
    

   public function dashboard()
    {
        return view('agent.auth.dashboard');
    }
     public function logout()
    {
        // return "ok";
         Auth::guard('agent')->logout();
         return redirect()->route('agent.login')->with('success','Logout Success');
    }
    public function forget_password()
    {
        return view('agent.auth.forget-password');
    }
    public function store(Request $request)
    {
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
            'prefix' => $data['prefix'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'company_name' => $data['company_name'],
            'job_title' => $data['job_title'],
            'country_dialing_code' => $data['country_dialing_code'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'finance_email' => $data['finance_email'],
            'password' => Hash::make($data['password']),
            'street_address' => $data['street_address'],
            'street_address_line_2' => $data['street_address_line_2'] ?? null,
            'city' => $data['city'],
            'state_province' => $data['state_province'],
            'postal_zip_code' => $data['postal_zip_code'],
            'country' => $data['country'],
            'director_title' => $data['director_title'],
            'director_first_name' => $data['director_first_name'],
            'director_last_name' => $data['director_last_name'],
            'director_job_title' => $data['director_job_title'],
            'director_phone_code' => $data['director_phone_code'],
            'director_phone_number' => $data['director_phone_number'],
            'director_email' => $data['director_email'],
            'students_per_year' => $data['students_per_year'],
            'destinations' => json_encode($data['destinations']),
            'litigation_status' => $data['litigation_status'],
            'australia_recruitment' => $data['australia_recruitment'],
            'other_institutions' => $data['other_institutions'],
            'college_name' => $data['college_name'],
            'creative_course' => $data['creative_course'],
            'university_preparation' => $data['university_preparation'],
            'adult_english_language' => $data['adult_english_language'],
            'junior_english_language' => $data['junior_english_language'],
            'direct_entry_to_university' => $data['direct_entry_to_university'],
            'company_established_year' => $data['company_established_year'],
            'branch_offices' => $data['branch_offices'],
            'counsellors_employed' => $data['counsellors_employed'],
            'icef_registered' => $data['icef_registered'],
            'source_of_information' => $data['source_of_information'],
            'reason_to_work_with_oxford' => $data['reason_to_work_with_oxford'],
            'first_referee_title' => $data['first_referee_title'],
            'first_referee_first_name' => $data['first_referee_first_name'],
            'first_referee_last_name' => $data['first_referee_last_name'],
            'first_referee_company_name' => $data['first_referee_company_name'],
            'first_referee_email' => $data['first_referee_email'],
            'first_referee_phone_country_code' => $data['first_referee_phone_country_code'],
            'first_referee_phone_number' => $data['first_referee_phone_number'],
            'first_referee_website' => $data['first_referee_website'],
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
        // Validate the request
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the agent exists
        $agent = Agent::where('email', $request->email)->first();

        if (!$agent) {
            return response()->json([
                'status' => false,
                'message' => 'Email not found.'
            ], 404);
        }

        // Generate a secure token
        $token = hash('sha256', time());

        // Save the token to the agent record (make sure 'token' column exists)
        $agent->token = $token;
        $agent->save();

        // Build the reset link
        $reset_link = url('agent/reset_password/' . $token . '/' . $request->email);

        // Email content
        $subject = "Reset Password";
        $message = '<a href="' . $reset_link . '">Click here to reset your password</a>';

        // Send email
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        // Return JSON response
        return response()->json([
            'status' => true,
            'message' => 'Please check your email for the password reset link.',
            'reset_link' => $reset_link // (optional: useful for debugging in Postman)
        ], 200);
    }



    public function reset_password($token, $email)
    {
        $agent = Agent::where('email', $email)->where('token', $token)->first();

        if (!$agent) {
            return redirect()->route('login')->with('error', 'Invalid or expired reset link');
        }

        // Show reset password form
        return view('agent.auth.reset-password', compact('email', 'token'));
    }
    public function reset_password_submit(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        // Find agent by email + token
        $agent = Agent::where('email', $request->email)
                    ->where('token', $request->token)
                    ->first();

        if (!$agent) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token or email.'
            ], 400); // 400 Bad Request
        }

        // Update password
        $agent->password = Hash::make($request->password);
        $agent->token = null; // clear reset token
        $agent->save();

        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully.'
        ], 200);
    }


}
