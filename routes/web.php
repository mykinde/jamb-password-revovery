<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

use App\Http\Controllers\VisitorCounterController;
Route::get('/', [VisitorCounterController::class, 'index']);

use App\Http\Controllers\RegistrationWizardController;
Route::prefix('registration')->group(function () {
    // Step 1
    Route::get('step-one', [RegistrationWizardController::class, 'stepOne'])->name('registration.step_one');
    Route::post('step-one', [RegistrationWizardController::class, 'postStepOne'])->name('registration.post_step_one');

    // Step 2
    Route::get('step-two', [RegistrationWizardController::class, 'stepTwo'])->name('registration.step_two');
    Route::post('step-two', [RegistrationWizardController::class, 'postStepTwo'])->name('registration.post_step_two');

    // Step 3
    Route::get('step-three', [RegistrationWizardController::class, 'stepThree'])->name('registration.step_three');
    Route::post('step-three', [RegistrationWizardController::class, 'postStepThree'])->name('registration.post_step_three');

    // Step 4 (Submit)
    Route::get('submit', [RegistrationWizardController::class, 'submit'])->name('registration.submit');
    Route::post('submit', [RegistrationWizardController::class, 'postSubmit'])->name('registration.post_submit');

    // Completion
    Route::get('complete', [RegistrationWizardController::class, 'complete'])->name('registration.complete');

    // Optional: Reset/Clear session data for the wizard
    Route::post('reset', [RegistrationWizardController::class, 'resetWizard'])->name('registration.reset');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
