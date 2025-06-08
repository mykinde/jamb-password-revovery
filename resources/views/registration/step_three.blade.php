

@extends('registration.layout')

@section('content')
    <form action="{{ route('registration.post_step_three') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <label for="phone">Phone Number</label>
            <input type="text" id="phoneInput" name="phone" value="{{ old('phone', $data['step_three']['phone'] ?? '') }}" required
                   class="@error('phone') border-red-500 @enderror">
            @error('phone')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

       

        <div class="form-group flex items-center mb-6">
            <input type="checkbox" id="sms_credit_bal_above_100" name="sms_credit_bal_above_100" value="1"
                   @checked(old('sms_credit_bal_above_100', $data['step_three']['sms_credit_bal_above_100'] ?? false))
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            <label for="sms_credit_bal_above_100" class="ml-2 block text-sm font-medium text-gray-700">SMS credit balance above 50 or 100 Naira</label>
            @error('sms_credit_bal_above_100')
                <p class="error-message ml-2">{{ $message }}</p>
            @enderror
        </div>

<div class="form-group flex items-center mb-4">
            <input type="checkbox" id="phone_available" name="phone_available" value="1"
                   @checked(old('phone_available', $data['step_three']['phone_available'] ?? false))
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                   <label for="send_sms" class="ml-2 block text-sm font-medium text-gray-700">Phone is available</label>
             @error('phone_available')
                <p class="error-message ml-2">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group flex items-center mb-4">
            <input type="checkbox" id="send_sms" name="send_sms" value="1"
                   @checked(old('send_sms', $data['step_three']['send_sms'] ?? false))
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
    
            <label for="phone_available" class="ml-2 block text-sm font-medium text-gray-700">From <span id="phone"></span> Send an SMS to 55019 with the exact message below (case-sensitive): 
               <br /> <span class="text-red-600 font-semibold"> PASSWORD {{ $data['step_two']['email'] ?? 'N/A' }}</span></label>
            @error('send_sms')
                <p class="error-message ml-2">{{ $message }}</p>
            @enderror
        </div>

        

        <div class="flex justify-between">
            <a href="{{ route('registration.step_two') }}" class="btn-secondary">Previous</a>
            <button type="submit" class="btn-primary">Next</button>
        </div>

        <div class="form-group flex items-center mb-6">
        <img src="{{ asset('jamb registration sms.png') }}" alt="Sample Image" class="mx-auto" />

        </div>
    </form>
@endsection



