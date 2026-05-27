<?php

namespace App\Services\Notification;

use App\Models\Notification;

class NotificationService
{
    protected $emailService;

    public function __construct(
        EmailService $emailService
    ) {
        $this->emailService = $emailService;
    }

    public function sendEmail(array $data)
    {

        $this->emailService->send(

            $data['recipient'],

            $data['title'] ?? 'Campus ERP Notification',

            $data['message']
        );

        return Notification::create([

            'user_id' => $data['user_id'] ?? null,

            'type' => 'EMAIL',

            'title' => $data['title'] ?? null,

            'message' => $data['message'],

            'recipient' => $data['recipient'],

            'status' => 'SENT',

            'sent_at' => now()
        ]);
    }
}