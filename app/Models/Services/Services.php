<?php


namespace App\Models\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use SoftDeletes;

    protected $table = [
        'id_department',
        'name',
        'description',
        'duration',
        'price',
        'active',
    ];

}
