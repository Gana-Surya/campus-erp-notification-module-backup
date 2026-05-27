<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;

use App\Http\Requests\Notification\StoreNotificationRequest;

use App\Services\Notification\NotificationService;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(
        NotificationService $notificationService
    ) {
        $this->notificationService = $notificationService;
    }

    public function store(
        StoreNotificationRequest $request
    ) {

        $this->notificationService->sendEmail([

            'recipient' => $request->recipient,

            'title' => 'Campus ERP Notification',

            'message' => $request->message

        ]);

        return back()->with(
            'success',
            'Notification sent successfully.'
        );
    }
}