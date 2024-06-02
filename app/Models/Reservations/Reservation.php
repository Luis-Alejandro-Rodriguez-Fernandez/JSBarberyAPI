<?php


namespace App\Models\Reservations;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = "reservation";

    protected $fillable = [
        'id_user',
        'id_service',
        'name',
        'last_name',
        'phone',
        'email',
        'price',
        'appointment',
        'confirmation',
    ];

}
