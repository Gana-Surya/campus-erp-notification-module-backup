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

    /**
     * Store Notification
     */
    public function store(
        StoreNotificationRequest $request
    ) {

        $data = [

            'recipient' => $request->recipient,

            'title' => 'Campus ERP Notification',

            'message' => $request->message
        ];

        switch ($request->type) {

            case 'SMS':

                $this->notificationService
                    ->sendSms($data);

                break;

            case 'WHATSAPP':

                $this->notificationService
                    ->sendWhatsapp($data);

                break;

            default:

                $this->notificationService
                    ->sendEmail($data);

                break;
        }

        return back()->with(
            'success',
            'Notification sent successfully.'
        );
    }
}