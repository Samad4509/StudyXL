<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskAssigned extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    // Delivery channel (email, database, etc.)
    public function via($notifiable)
    {
        return ['database', 'mail']; // database + email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Task Assigned')
                    ->line('A new task has been assigned to you: ' . $this->task->title)
                    ->action('View Task', url('/tasks/' . $this->task->id))
                    ->line('Thank you!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'message' => 'A new task has been assigned to you by admin.'
        ];
    }
}
