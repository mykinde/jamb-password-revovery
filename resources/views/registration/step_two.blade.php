@extends('registration.layout')

@section('content')
    <form action="{{ route('registration.post_step_two') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <label for="email">Email Address (Optional if you wish not to submit)</label>
            <input type="email" id="email" name="email" value="{{ old('email', $data['step_two']['email'] ?? '') }}"
                   class="@error('email') border-red-500 @enderror">
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group flex items-center mb-6">
            <input type="checkbox" id="email_acessible" name="email_acessible" value="1"
                   @checked(old('email_acessible', $data['step_two']['email_acessible'] ?? false))
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            <label for="email_acessible" class="ml-2 block text-sm font-medium text-gray-700">Email is accessible:
                <br>I can login to my (JAMB) email use JAMB efacility to reset and retrieve  a new password  
                <a href="https://efacility.jamb.gov.ng/forgot" target="_blank" class="text-blue-600 hover:underline">
        Forgot your JAMB password?</a>
        <p><span class="font-bold">IF NOT ACCESSIBLE</span>, click <span class="font-semibold">Next</span>.</p>

<p>
    <span class="font-bold">2. CHECK</span> your JAMB registration <span class="font-bold">slip</span>. 
    The email must exactly match what appears on the slip — regardless of any errors made during the registration process.
</p>

<p>If you're not sure, contact an accredited CBT center.</p>

<p>
    <span class="font-bold">3.</span> The login to the JAMB email facility must be the exact email used during the registration process.
</p>
            </label>
            @error('email_acessible')
                <p class="error-message ml-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('registration.step_one') }}" class="btn-secondary">Previous</a>
            <button type="submit" class="btn-primary">Next</button>
        </div>

        
        <div class="form-group flex items-center mb-6">
        <img src="{{ asset('jamb registration slip.png') }}" alt="Sample Image" class="mx-auto" />

        </div>
    </form>
@endsection