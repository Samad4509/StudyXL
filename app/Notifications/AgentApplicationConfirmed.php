<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AgentApplicationConfirmed extends Notification
{
    use Queueable;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    // কোন মাধ্যমে যাবে
    public function via($notifiable)
    {
        return ['database']; // Admin panel notification
    }

    // Notification data
    public function toDatabase($notifiable)
    {
        return [
            'application_id' => $this->application->id,
            'student_name'   => $this->application->student_name,
            'agent_name'     => $this->application->agent_name,
            'program_name'   => $this->application->program_name,
            'message'        => 'Agent একটি নতুন Application confirm করেছে'
        ];
    }
}
