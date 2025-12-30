<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LogSubmitted extends Notification
{
    use Queueable;

    protected $log;
    protected $type;

    public function __construct($log, $type)
    {
        $this->log = $log;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan di tabel notifications
    }

    public function toArray($notifiable)
    {
        if ($this->type === 'verification_needed') {
            return [
                'title' => 'Verification Required',
                'message' => 'Bawahan Anda (' . $this->log->user->user_name . ') mengirim log baru.',
                'log_id' => $this->log->id_logs
            ];
        }

        if ($this->type === 'log_created') {
            return [
                'title' => 'Log Created Successfully',
                'message' => 'Log harian Anda tanggal ' . $this->log->log_date->format('d M Y') . ' berhasil dibuat (Status: PENDING).',
                'log_id' => $this->log->id_logs
            ];
        }

        // Untuk Status Approved / Rejected
        $statusText = strtoupper($this->log->status);
        return [
            'title' => 'Log ' . ucfirst($this->log->status),
            'message' => 'Log harian Anda tanggal ' . $this->log->log_date->format('d M Y') . ' telah ' . $statusText,
            'note' => $this->log->verification_note, // Akan tampil jika rejected
            'log_id' => $this->log->id_logs
        ];
    }
}