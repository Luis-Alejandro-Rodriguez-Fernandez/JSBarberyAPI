<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = "admin_config";

    protected $fillable = [
        'phone',
        'email',
        'first_journal',
        'second_journal',
        'disabled_days',
        'instagram',
        'tiktok',
    ];
}
