<?php

use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\ProfileController;

use App\Models\Notification;
use App\Models\NotificationTemplate;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})
->middleware(['auth', 'verified'])
->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Management Routes
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Notification Dashboard Routes
|--------------------------------------------------------------------------
|
| Protected using authentication middleware.
| Only logged-in users can access notification features.
|
*/

Route::get('/notifications', function () {

    $notifications = Notification::latest()->get();

    $templates = NotificationTemplate::all();

    return view(
        'notifications.index',
        compact(
            'notifications',
            'templates'
        )
    );

})->middleware('auth');

Route::post(
    '/notifications',
    [NotificationController::class, 'store']
)->middleware('auth');

/*
|--------------------------------------------------------------------------
| TEMPORARY TESTING ROUTES
|--------------------------------------------------------------------------
|
| These routes were used during development for:
| - Gmail SMTP testing
| - NotificationService verification
| - End-to-end email workflow testing
|
| Keep for demonstration/testing purposes.
| Remove or secure before production deployment.
|
*/

/*
|--------------------------------------------------------------------------
| SMTP Email Testing Route
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| NotificationService Testing Route
|--------------------------------------------------------------------------
*/

Route::get('/send-test-notification', function () {

    app(
        \App\Services\Notification\NotificationService::class
    )->sendEmail([

        'recipient' => 'suryahero2004@gmail.com',

        'title' => 'ERP Service Test',

        'message' => 'NotificationService is working properly.'

    ]);

    return 'Notification sent successfully.';
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';