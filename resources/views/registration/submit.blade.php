@extends('registration.layout')

@section('content')
    <form action="{{ route('registration.post_submit') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <label for="new_password_received">New Password Received? </label>
            <input type="checkbox" id="new_password_received" name="new_password_received" value="1"
                   @checked(old('new_password_received', $data['submit']['new_password_received'] ?? false))
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            @error('new_password_received')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-3 text-sm text-gray-800">
    <p><span class="font-bold">If Yes, Congratulations.</p>

    <p>
        <span class="font-bold">2. Visit</span> <a href="https://efacility.jamb.gov.ng/login" target="_blank"> JAMB eFacility to Login</a>. 
        using {{ $data['step_two']['email'] ?? 'N/A' }} as email and the password received via sms as jamb password
    </p>

    <p>If all failed, visit JAMB State office or create a ticket on  <a href="https://support.jamb.gov.ng/" target="_blank" rel="noopener noreferrer">
    JAMB Support </a> (for loss of sim etc).</p>

    
</div>

        <div class="form-group mb-4">
            <label for="recovery_successful">Recovery Successful: </label>
            <input type="checkbox" id="recovery_successful" name="recovery_successful" value="1"
                   @checked(old('recovery_successful', $data['submit']['recovery_successful'] ?? false))
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            @error('recovery_successful')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <p>
        To encourage the developer, kindly checked the checkbox if jamb login is successful and submit the registration form as a feedback. for further contact or donation, email g3send@gmail.com
    </p>
<div></div>
        <div class="form-group mb-4">
            <label for="password">Password: for this form (Not sms from JAMB)</label>
            <input type="password" id="password" name="password" required
                   class="@error('password') border-red-500 @enderror">
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-6">
            <label for="password_confirmation">Confirm Password for this form</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('registration.step_three') }}" class="btn-secondary">Previous</a>
            <button type="submit" class="btn-primary">Complete Registration</button>
        </div>
    </form>
@endsection
