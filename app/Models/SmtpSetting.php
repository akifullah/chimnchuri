<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpSetting extends Model
{
    protected $fillable = [
        'mailer',
        'host',
        'username',
        'password',
        'port',
        'encryption',
        'from_address',
        'from_name',
        'is_active',
    ];
}
