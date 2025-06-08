

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 antialiased font-sans">

    <div class="min-h-screen flex flex-col justify-center items-center text-center px-6">
        <!-- Logo or App Title -->
        <h1 class="text-5xl font-bold mb-4 text-indigo-600">
            {{ config('app.name') }}
        </h1>
        <p class="text-lg text-gray-600 mb-10">
        Welcome to {{ config('app.name') }}

Do you have your JAMB registration printout ready before proceeding?<br>
The printout can be either a soft copy or a hard copy. You can also <br>
ask an accredited CBT center to retrieve your accurate JAMB-registered phone number.<br>

Having this information will ensure a 100% successful JAMB password recovery attempt.
        </p>

        <!-- Auth Links -->
        <div class="space-x-4">
            @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   class="inline-block px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Login
                </a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('registration.step_one') }}"
                   class="inline-block px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                  Get Started
                </a>
            @endif
        
        </div>

        <!-- Footer -->
        <footer class="mt-16 text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. 
            <p>All rights reserved G3 Technologies</p>
            <p>This page has been visited <strong>{{ $count }}</strong> times.</p>
        </footer>
    </div>

</body>
</html>

