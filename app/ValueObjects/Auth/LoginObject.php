<?php

namespace App\ValueObjects\Auth;

use Exception;
use Illuminate\Http\Request;

class LoginObject
{
    protected $email;
    protected $password;

    /**
     * @throws Exception
     */
    public function __construct(Request $request)
    {
        $this->email = $request->email;
        $this->password = $request->password;

        $this->validateEmail();
        $this->validatePassword();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @throws Exception
     */
    private function validateEmail(): void
    {
        if (empty($this->email)) {
            throw new Exception("Debe introducir el correo electrónico");
        }
    }

    /**
     * @throws Exception
     */
    private function validatePassword(): void
    {
        if (empty($this->password)) {
            throw new Exception("Debe introducir la contraseña");
        }
    }
}
