<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $table = 'daily_logs';
    protected $primaryKey = 'id_logs'; // Custom PK

    protected $fillable = [
        'user_id', 'log_date', 'activity_summary', 'status', 
        'verified_by', 'verification_note', 'verified_at'
    ];

    protected $casts = [
        'log_date' => 'date',
        'verified_at' => 'datetime',
    ];

    // === RELASI (Hanya boleh ada 1 untuk setiap nama fungsi) ===

    // 1. Relasi ke User (Pembuat Log)
    public function user()
    {
        // Parameter: (Model Tujuan, Foreign Key di sini, Primary Key di sana)
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    // 2. Relasi ke Verifikator (Atasan yang memverifikasi)
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id_user');
    }
}