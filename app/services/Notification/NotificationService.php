<?php

namespace App\Services\Notification;

use App\Models\Notification;

class NotificationService
{
    public function createLog(array $data)
    {
        return Notification::create([

            'user_id' => $data['user_id'] ?? null,

            'type' => $data['type'],

            'title' => $data['title'] ?? null,

            'message' => $data['message'],

            'recipient' => $data['recipient'],

            'status' => $data['status'],

            'sent_at' => now()
        ]);
    }
}