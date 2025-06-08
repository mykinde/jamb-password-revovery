<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; // Import for Rule::in and Rule::unique

class RegistrationWizardController extends Controller
{
    // --- Step 1: Basic Information ---
    public function stepOne(Request $request)
    {
        // Retrieve data from session or initialize an empty array
        $data = $request->session()->get('registration_wizard', []);
        return view('registration.step_one', compact('data'));
    }

    public function postStepOne(Request $request)
    {
        // Validate incoming data for step one
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profile_code' => ['nullable', 'string', 'max:255'],
            'reg_number' => ['nullable', 'string', 'max:255'],
            'printout' => ['required', 'boolean'],
        ]);

        // Store validated data in the session
        $request->session()->put('registration_wizard.step_one', $validatedData);

        // Redirect to the next step
        return redirect()->route('registration.step_two');
    }

    // --- Step 2: Email Information ---
    public function stepTwo(Request $request)
    {
        // Ensure step one data exists before proceeding
        if (!$request->session()->has('registration_wizard.step_one')) {
            return redirect()->route('registration.step_one')->with('error', 'Please complete Step 1 first.');
        }

        $data = $request->session()->get('registration_wizard', []);
        return view('registration.step_two', compact('data'));
    }

    public function postStepTwo(Request $request)
    {
        // Validate incoming data for step two
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(auth()->id())], // Ensure unique email if not null
            'email_acessible' => ['required', 'boolean'],
        ]);

        // Store validated data in the session
        $request->session()->put('registration_wizard.step_two', $validatedData);

        // Redirect to the next step
        return redirect()->route('registration.step_three');
    }

    // --- Step 3: Phone Information ---
    public function stepThree(Request $request)
    {
        // Ensure previous step data exists before proceeding
        if (!$request->session()->has('registration_wizard.step_two')) {
            return redirect()->route('registration.step_two')->with('error', 'Please complete Step 2 first.');
        }

        $data = $request->session()->get('registration_wizard', []);
        return view('registration.step_three', compact('data'));
    }

    public function postStepThree(Request $request)
    {
        // Validate incoming data for step three
        $validatedData = $request->validate([
            'phone' => ['required', 'numeric', 'min:11', Rule::unique('users', 'phone')->ignore(auth()->id())], // Ensure unique phone
            'phone_available' => ['required', 'boolean'],
            'sms_credit_bal_above_100' => ['required', 'boolean'],
        ]);

        // Store validated data in the session
        $request->session()->put('registration_wizard.step_three', $validatedData);

        // Redirect to the submission step
        return redirect()->route('registration.submit');
    }

    // --- Step 4: Submission (Password & Recovery) ---
    public function submit(Request $request)
    {
        // Ensure all previous step data exists before submitting
        if (!$request->session()->has('registration_wizard.step_three')) {
            return redirect()->route('registration.step_three')->with('error', 'Please complete Step 3 first.');
        }

        $data = $request->session()->get('registration_wizard', []);
        return view('registration.submit', compact('data'));
    }

    public function postSubmit(Request $request)
    {
        // Validate incoming data for submission step
        $validatedData = $request->validate([
            'new_password_received' => ['required', 'boolean'],
            'recovery_successful' => ['required', 'boolean'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' checks for 'password_confirmation' field
        ]);

        // Store validated data in the session for the final step
        $request->session()->put('registration_wizard.submit', $validatedData);

        // Retrieve all data from the session
        $registrationData = $request->session()->get('registration_wizard');

        // Combine all data into a single array
        $userData = array_merge(
            $registrationData['step_one'] ?? [],
            $registrationData['step_two'] ?? [],
            $registrationData['step_three'] ?? [],
            $registrationData['submit'] ?? []
        );

        // Hash the password before saving
        $userData['password'] = Hash::make($userData['password']);

        // Create the user
        try {
            User::create($userData);
            // Clear the session data after successful submission
            $request->session()->forget('registration_wizard');
            return redirect()->route('registration.complete')->with('success', 'Registration completed successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('User registration failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    // --- Completion Page ---
    public function complete(Request $request)
    {
        return view('registration.complete');
    }

    // --- Reset Wizard (Optional) ---
    public function resetWizard(Request $request)
    {
        $request->session()->forget('registration_wizard');
        return redirect()->route('registration.step_one')->with('info', 'Registration wizard reset.');
    }

}