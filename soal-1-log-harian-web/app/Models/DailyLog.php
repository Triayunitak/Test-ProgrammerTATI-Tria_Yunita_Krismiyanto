<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    use HasFactory;

    protected $table = 'daily_logs';
    protected $primaryKey = 'id_logs';

    protected $fillable = [
        'user_id',
        'log_date',
        'activity_summary',
        'status',
        'verified_by',
        'verification_note',
        'verified_at',
    ];

    protected $casts = [
        'log_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
