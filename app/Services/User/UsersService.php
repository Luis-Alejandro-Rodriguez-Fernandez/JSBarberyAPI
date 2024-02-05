<?php

namespace App\Services\User;

use App\Repositories\Users\UsersRepository;
use Illuminate\Database\Eloquent\Model;

class UsersService
{
    protected UsersRepository $repository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->repository = $usersRepository;
    }

    public function findByEmail(string $email)
    {
        return $this->repository->findByEmail($email);
    }

    public function createUser($register): Model
    {
        return $this->repository->createUser($register);
    }

}
