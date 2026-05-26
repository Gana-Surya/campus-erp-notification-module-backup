<?php

use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});

Route::post(
    '/notifications',
    [NotificationController::class, 'store']
);

Route::get('/test-email', function () {

    Mail::raw(
        'This is a test email from Campus ERP Notification Module.',
        function ($message) {

            $message->to('suryahero2004@gmail.com')
                    ->subject('Campus ERP Test Email');

        }
    );

    return 'Test email sent successfully.';
});

require __DIR__.'/auth.php';