<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPendaftaranUpdated extends Notification
{
    use Queueable;

    protected $status;
    protected $pesan;
    protected $pendaftaran_id;

    public function __construct($status, $pesan = null, $pendaftaran_id = null)
    {
        $this->status = $status;
        $this->pesan = $pesan;
        $this->pendaftaran_id = $pendaftaran_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * THIS FIX: Add toDatabase() for Laravel 8 compatibility
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Pendaftaran Diperbarui',
            'url' => route('santri.pendaftaran.show', $this->pendaftaran_id),
            'status' => $this->status,
            'pesan' => $this->pesan,
            'message' => "Status pendaftaran Anda diubah menjadi '{$this->status}'" .
                ($this->pesan ? ". Catatan: {$this->pesan}" : ".")
        ];
    }
}
