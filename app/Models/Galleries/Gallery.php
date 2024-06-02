<?php


namespace App\Models\Galleries;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = "gallery";

    protected $fillable = [
        'id_department',
        'url',
        'date',
        'active',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getDepartmentId(): int
    {
        return $this->id_department;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDate(): string
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }

    public function getActive(): bool
    {
        return $this->active;
    }
}
