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

        $this->notificationService->createLog([

            'type' => $request->type,

            'recipient' => $request->recipient,

            'message' => $request->message,

            'status' => 'SENT'
        ]);

        return back()->with(
            'success',
            'Notification logged successfully.'
        );
    }
}