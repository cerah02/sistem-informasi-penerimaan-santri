<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPendaftaranUpdated extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($status, $pesan = null, $pendaftaran_id = null)
    {
        $this->data = [
            'title' => 'Status Pendaftaran Diperbarui',
            'message' => "Status pendaftaran Anda diubah menjadi '{$status}'" . ($pesan ? " dengan catatan: {$pesan}" : "."),
            'url' => route('dashboard', $pendaftaran_id),
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return $this->data;
    }
}
