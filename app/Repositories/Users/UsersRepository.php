<?php

namespace App\Repositories\Users;

use App\Models\Roles\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UsersRepository
{
    public function find(?int $id): User|Model|null
    {
        return User::query()->find($id);
    }

    public function findByEmail(string $email): object|null
    {
        return User::query()->where('email', '=', $email)->first();
    }

    public function createUser($register): Model
    {
        return User::query()->create([
            'name' => $register->getName(),
            'last_name' => $register->getLastName(),
            'role_id'=> Roles::getDefaultRole(),
            'email' => $register->getEmail(),
            'password' => bcrypt($register->getPassword()),
            'phone' => $register->getPhone(),
            'birdthday' => $register->getBirthday(),
        ]);
    }
}
