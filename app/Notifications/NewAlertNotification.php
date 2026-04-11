<?php

namespace App\Notifications;

use App\Models\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Alert $alert;

    /**
     * Create a new notification instance.
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Kirim via email + database + broadcast (real-time)
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification (EMAIL).
     */
    public function toMail(object $notifiable): MailMessage
    {
        $severityColor = match ($this->alert->severity) {
            'critical' => 'danger',
            'high'     => 'warning',
            'medium'   => 'info',
            'low'      => 'secondary',
            default    => 'secondary',
        };

        $subject = "[ALERT " . strtoupper($this->alert->severity) . "] " . $this->alert->title;

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Terdapat **alert baru** pada mesin milik Anda:')
            ->line('**Mesin:** ' . ($this->alert->machine?->name ?? 'Unknown Machine'))
            ->line('')
            ->line('**' . $this->alert->title . '**')
            ->line($this->alert->message)
            ->line('')
            ->line('Tipe Alert     : ' . ucwords(str_replace('_', ' ', $this->alert->alert_type)))
            ->line('Tingkat Bahaya : ' . strtoupper($this->alert->severity))
            ->when($this->alert->expires_at, function (MailMessage $mail) {
                $mail->line('Berlaku hingga: ' . $this->alert->expires_at->format('d M Y H:i'));
            })
            ->action('Lihat Detail & Tindak Lanjut', url('/alerts/' . $this->alert->id))
            ->line('Mohon segera ditindak lanjuti agar tidak terjadi kerusakan lebih lanjut.')
            ->salutation('Terima kasih,');
    }

    /**
     * Get the array representation of the notification (Database).
     */
    public function toArray(object $notifiable): array
    {
        return [
            'alert_id'     => $this->alert->id,
            'machine_id'   => $this->alert->machine_id,
            'title'        => $this->alert->title,
            'message'      => $this->alert->message,
            'alert_type'   => $this->alert->alert_type,
            'severity'     => $this->alert->severity,
            'status'       => $this->alert->status ?? 'unread',
            'created_at'   => $this->alert->created_at->toDateTimeString(),
            'action_url'   => '/alerts/' . $this->alert->id,
            'type'         => 'new_alert',
        ];
    }

    /**
     * Get the broadcast representation (Real-time).
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'alert_id'   => $this->alert->id,
            'title'      => $this->alert->title,
            'message'    => $this->alert->message,
            'severity'   => $this->alert->severity,
            'type'       => 'new_alert',
            'created_at' => now()->toDateTimeString(),
        ]);
    }
}
