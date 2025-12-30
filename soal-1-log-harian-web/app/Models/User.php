<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user'; // Custom PK
    public $timestamps = true;

    protected $fillable = [
        'user_name', 'email_user', 'user_password', 'role', 'supervisor_id'
    ];

    protected $hidden = ['user_password'];

    // kolom password = 'user_password'
    public function getAuthPassword()
    {
        return $this->user_password;
    }
}
