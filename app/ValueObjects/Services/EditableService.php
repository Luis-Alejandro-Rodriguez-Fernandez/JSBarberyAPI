<?php

namespace App\ValueObjects\Services;

use App\ValueObjects\Generals\EditableObject;
use Exception;

class EditableService extends EditableObject
{
    private int $id;
    private string $name;
    private string $description;
    private string $idDepartment;
    private string $duration;
    private string $price;
    private bool $active;

    private function __construct(
        int $id,
        string $name,
        int $idDepartment,
        string $duration,
        string $price,
        string $description,
        bool $active,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->idDepartment = $idDepartment;
        $this->duration = $duration;
        $this->price = $price;
        $this->description = $description;
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIdDepartment(): int
    {
        return $this->idDepartment;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDuration(): int
    {
        return intval($this->duration);
    }

    public function getPrice(): float
    {
        return floatval($this->price);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @throws Exception
     */
    public static function create(
        int $id,
        string $name,
        int $idDepartment,
        string $duration,
        string $price,
        string $description = "",
        bool $active = true,
    ): self
    {
        if (empty($name)) {
            throw new Exception("El nombre es obligatorio");
        }

        if (empty($idDepartment)) {
            throw new Exception("El departamento es obligatorio");
        }

        if (empty($duration)) {
            throw new Exception("El departamento es obligatorio");
        }

        if (empty($price)) {
            throw new Exception("El departamento es obligatorio");
        }

        return new self($id, $name, $idDepartment, $duration, $price, $description, $active);
    }
}
