<?php


namespace App\Models\Reviews;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{
    use SoftDeletes;

    protected $table = [
        'id_reservation',
        'rating',
        'description',
    ];
}
