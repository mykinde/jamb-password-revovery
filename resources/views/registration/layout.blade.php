<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 28rem; /* Equivalent to md:max-w-md */
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            color: #374151;
            box-sizing: border-box;
        }
        .form-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn-primary {
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #4338ca;
        }
        .btn-secondary {
            background-color: #6b7280;
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">{{ config('app.name') }} Wizard</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif

        <div class="progress-bar mb-6">
            <ul class="flex justify-between text-sm font-medium text-gray-500">
                <li class="@if(Route::currentRouteName() == 'registration.step_one' || request()->session()->has('registration_wizard.step_one')) text-indigo-600 @endif">Step 1</li>
                <li class="@if(Route::currentRouteName() == 'registration.step_two' || request()->session()->has('registration_wizard.step_two')) text-indigo-600 @endif">Step 2</li>
                <li class="@if(Route::currentRouteName() == 'registration.step_three' || request()->session()->has('registration_wizard.step_three')) text-indigo-600 @endif">Step 3</li>
                <li class="@if(Route::currentRouteName() == 'registration.submit' || request()->session()->has('registration_wizard.submit')) text-indigo-600 @endif">Submit</li>
                <li class="@if(Route::currentRouteName() == 'registration.complete') text-indigo-600 @endif">Complete</li>
            </ul>
        </div>

        @yield('content')
    </div>
    <script>
document.getElementById('phoneInput').addEventListener('keyup', function() {
    document.getElementById('phone').textContent = this.value;
});
</script>
</body>
</html>
