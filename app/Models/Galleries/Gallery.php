<?php


namespace App\Models\Galleries;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = [
        'id_department',
        'url',
        'date',
        'active',
    ];
}
