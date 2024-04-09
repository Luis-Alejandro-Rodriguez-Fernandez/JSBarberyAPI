<?php

namespace App\ValueObjects\Auth;

use App\Services\User\UsersService;
use Exception;
use Illuminate\Http\Request;

class RegisterObject
{
    protected $name;
    protected $last_name;
    protected $password;
    protected $passwordConfirmation;
    protected $email;
    protected $phone;
    protected $birthday;
    protected UsersService $usersService;

    /**
     * @throws Exception
     */
    public function __construct(Request $request, UsersService $usersService)
    {
        $this->name = $request->name;
        $this->last_name = $request->last_name;
        $this->email = $request->email;
        $this->password = $request->password;
        $this->passwordConfirmation = $request->password_confirmation;
        $this->phone = $request->phone;
        $this->birthday = $request->birthday;
        $this->usersService = $usersService;

        $this->validateName();
        $this->validateEmail();
        $this->validatePassword();
        $this->validatePhone();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @throws Exception
     */
    private function validateName(): void
    {
        if (empty($this->name)) {
            throw new Exception("Debe introducir su nombre");
        }
    }

    /**
     * @throws Exception
     */
    private function validateEmail(): void
    {
        if (empty($this->email)) {
            throw new Exception("Debe introducir el correo electrónico");
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Debe introducir el correo electrónico válido");
        }

        $emailExists = $this->usersService->findByEmail($this->email);

        if (!is_null($emailExists)) {
            throw new Exception("El correo electrónico ya está en uso");
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

        if (strlen($this->password) < 6) {
            throw new Exception("La contraseña debe tener 6 o más carácteres");
        }

        if ($this->password !== $this->passwordConfirmation) {
            throw new Exception("Las contraseñas no coinciden");
        }
    }

    /**
     * @throws Exception
     */
    private function validatePhone(): void
    {
        if (empty($this->phone)) {
            throw new Exception("Debe introducir un número de teléfono");
        }
    }

}
