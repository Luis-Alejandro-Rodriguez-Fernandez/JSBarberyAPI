<?php

namespace App\ValueObjects\Departments;

use App\ValueObjects\Generals\EditableObject;
use Exception;

class EditableDepartment extends EditableObject
{
    private int $id;
    private string $name;

    private function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws Exception
     */
    public static function create(int $id, string $name): self
    {
        if (empty($name)) {
            throw new Exception("El nombre es obligatorio");
        }

        return new self($id, $name);
    }
}
