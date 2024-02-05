<?php

use App\Resources\Auth\UserResource;

class SessionUserObject
{
    protected $user;

    /**
     * @throws Exception
     */
    public function __constuct(): void
    {
        $this->validateUserSession();

        $this->user = auth()->user();
    }

    public function getUser(): UserResource
    {
        return new UserResource($this->user);
    }

    /**
     * @throws Exception
     */
    private function validateUserSession(): void
    {
        if (!auth()->check()) {
            throw new Exception('No se encontró la sesión');
        }
    }
}
