<?php
namespace App\ValueObjects\Auth;

class LogoutObject
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function getUser()
    {
        return $this->user;
    }
}
