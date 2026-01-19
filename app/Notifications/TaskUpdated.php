<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskUpdated extends Notification
{
    use Queueable;

    protected $task;
    protected $agent;

    public function __construct($task, $agent)
    {
        $this->task = $task;
        $this->agent = $agent;
    }

    // Delivery channels: database only (mail optional)
    public function via($notifiable)
    {
        return ['database']; // mail রাখতে চাইলে এখানে add করবেন
    }

    // Database notification content
    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'title' => 'Task Updated: ' . $this->task->title,  // এখানে title
            'message' => 'Task updated by agent: ' . $this->agent->name,
            'status' => $this->task->status,
        ];
    }
}
