<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationNotification extends Notification
{
    use Queueable;

    public $applicationId;
    public $type;

    public function __construct($applicationId, $type = 'student')
    {
        $this->applicationId = $applicationId;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database']; // Only database notification
    }

    public function toDatabase($notifiable)
    {
        return [
            'application_id' => $this->applicationId,
            'type' => $this->type,
            'message' => $this->type === 'student'
                        ? 'New student application submitted.'
                        : 'New agent application submitted.',
        ];
    }
}
