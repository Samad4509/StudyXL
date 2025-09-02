<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);
        

    //     return redirect(RouteServiceProvider::HOME);
    // }

 public function store(Request $request)
{
    // Get JSON input
    $data = json_decode($request->getContent(), true);

    // Validate input
    $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'destination' => 'required|string|max:255',
        'study_level' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'nationality' => 'required|string|max:255',
        'elp' => 'nullable|string|max:255',
        'passport' => 'nullable|string|max:255',
    ], [
        'name.required' => 'The name field is required.',
        'name.string' => 'The name must be a string.',
        'name.max' => 'The name may not be greater than 255 characters.',
        
        'email.required' => 'The email field is required.',
        'email.string' => 'The email must be a string.',
        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'The email may not be greater than 255 characters.',
        'email.unique' => 'This email address is already registered.',
        
        'password.required' => 'The password field is required.',
        'password.string' => 'The password must be a string.',
        'password.min' => 'The password must be at least 8 characters.',
        'password.confirmed' => 'Please confirm your password.',
        
        'destination.required' => 'Please select a destination.',
        'destination.string' => 'Destination must be a string.',
        'destination.max' => 'Destination may not be greater than 255 characters.',
        
        'study_level.required' => 'Please select your study level.',
        'study_level.string' => 'Study level must be a string.',
        'study_level.max' => 'Study level may not be greater than 255 characters.',
        
        'subject.required' => 'Please select your subject.',
        'subject.string' => 'Subject must be a string.',
        'subject.max' => 'Subject may not be greater than 255 characters.',
        
        'nationality.required' => 'Please select your nationality.',
        'nationality.string' => 'Nationality must be a string.',
        'nationality.max' => 'Nationality may not be greater than 255 characters.',
        
        'elp.string' => 'ELP score must be a string.',
        'elp.max' => 'ELP score may not be greater than 255 characters.',
        
        'passport.string' => 'Passport number must be a string.',
        'passport.max' => 'Passport number may not be greater than 255 characters.',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    // Create user
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'destination' => $data['destination'],
        'study_level' => $data['study_level'],
        'subject' => $data['subject'],
        'nationality' => $data['nationality'],
        'elp' => $data['elp'] ?? null,
        'passport' => $data['passport'] ?? null,
    ]);

    // Trigger event
    event(new Registered($user));

    // Generate token
    $token = $user->createToken('auth_token')->plainTextToken;

    // Return JSON response
    return response()->json([
        'success' => true,
        'message' => 'User registered successfully',
        'data' => [
            'user' => $user,
            'token' => $token
        ]
    ], 201);
}
}
