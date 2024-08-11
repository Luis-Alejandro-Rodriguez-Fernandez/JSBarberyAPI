<?php


namespace App\Models\Roles;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;

    protected $table = "roles";

    protected $fillable = [
        'name'
    ];

    private const BOSS_USER_ROLE = 1;
    private const EMPLOYEE_USER_ROLE = 2;
    private const DEFAULT_USER_ROLE = 3;

    public static function getBossRole(): int
    {
        return self::BOSS_USER_ROLE;
    }

    public static function getEmployeeRole(): int
    {
        return self::EMPLOYEE_USER_ROLE;
    }

    public static function getDefaultRole(): int
    {
        return self::DEFAULT_USER_ROLE;
    }
}
