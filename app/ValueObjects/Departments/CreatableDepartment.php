<?php

namespace App\ValueObjects\Departments;

use App\ValueObjects\Generals\CreatableObject;
use Exception;

class CreatableDepartment extends CreatableObject
{
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws Exception
     */
    public static function create(string $name = ""): self
    {

        if (empty($name)) {
            throw new Exception("El nombre es obligatorio");
        }

        return new self($name);
    }

}
