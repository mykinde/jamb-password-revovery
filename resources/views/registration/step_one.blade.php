

@extends('registration.layout')

@section('content')
    <form action="{{ route('registration.post_step_one') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $data['step_one']['name'] ?? '') }}" required
                   class="@error('name') border-red-500 @enderror">
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="profile_code">Profile Code (Optional)</label>
            <input type="text" id="profile_code" name="profile_code" value="{{ old('profile_code', $data['step_one']['profile_code'] ?? '') }}"
                   class="@error('profile_code') border-red-500 @enderror">
            @error('profile_code')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="reg_number">JAMB Registration Number (Optional)</label>
            <input type="text" id="reg_number" name="reg_number" value="{{ old('reg_number', $data['step_one']['reg_number'] ?? '') }}"
                   class="@error('reg_number') border-red-500 @enderror">
            @error('reg_number')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group flex items-center mb-6">
            <input type="checkbox" id="printout" name="printout" value="1"
                   @checked(old('printout', $data['step_one']['printout'] ?? false))
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            <label for="printout" class="ml-2 block text-sm font-medium text-gray-700"> <p class="font-semibold">Printout: Yes!</p>
    <ul class="list-disc list-inside">
        <li>I can access my JAMB registration slip</li>
        <li>OR I am sure of the phone number I used during JAMB registration (or the email)</li>
    </ul>
            </label>
            @error('printout')
                <p class="error-message ml-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary">Next</button>
        </div>

        <div class="form-group flex items-center mb-6">
        <img src="{{ asset('jamb registration slip.png') }}" alt="Sample Image" class="mx-auto" />

        </div>
        
    </form>
@endsection
