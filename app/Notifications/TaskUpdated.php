<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskUpdated extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Updated by Agent')
            ->greeting('Hello ' . $notifiable->name)
            ->line('The task "' . $this->task->title . '" has been updated by the assigned agent.')
            ->line('Status: ' . $this->task->status)
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Thank you!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'status' => $this->task->status,
            'updated_by_agent_id' => $this->task->updated_by_agent ?? null,
            'message' => 'The task has been updated by the agent.',
            'updated_at' => $this->task->updated_at,
        ];
    }
}
