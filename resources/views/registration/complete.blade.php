@extends('registration.layout')

@section('content')
    <div class="text-center">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Registration Complete!</h3>
        <p class="text-gray-600 mb-6">Your account has been successfully created.</p>
        <p class="text-gray-600 mb-6">Congratulations on your JAMB efacility access and password Revovery.</p>
        <a href="{{ route('registration.step_one') }}" class="btn-primary">Start New Registration/Recovery</a>
    </div>
@endsection