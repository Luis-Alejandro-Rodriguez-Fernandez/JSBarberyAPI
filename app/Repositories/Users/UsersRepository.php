<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UsersRepository
{
    public function findByEmail(string $email): object|null
    {
        return User::query()->where('email', '=', $email)->first();
    }

    public function createUser($register): Model
    {
        return User::query()->create([
            'name' => $register->getName(),
            'last_name' => $register->getLastName(),
            'email' => $register->getEmail(),
            'password' => bcrypt($register->getPassword()),
            'phone' => $register->getPhone(),
            'birdthday' => $register->getBirthday(),
        ]);
    }
}
