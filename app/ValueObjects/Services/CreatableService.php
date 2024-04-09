<?php

namespace App\ValueObjects\Services;

use App\ValueObjects\Generals\CreatableObject;
use Exception;
use Illuminate\Support\Facades\DB;

class  CreatableService extends CreatableObject
{
    private string $name;
    private string $description;
    private string $idDepartment;
    private string $duration;
    private string $price;

    private function __construct(
        int $idDepartment,
        string $name,
        string $duration,
        string $price,
        string $description,

    )
    {
        $this->idDepartment = $idDepartment;
        $this->name = $name;
        $this->description = $description;
        $this->duration = $duration;
        $this->price = $price;
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
     * @throws Exception
     */
    public static function create(
        int $idDepartment,
        string $name,
        int $duration,
        float $price,
        string $description = "",
    ): self
    {

        if (empty($idDepartment)) {
            throw new Exception("El departamento es obligatorio");
        }

        $existDepartment = DB::table("departments")->find($idDepartment);

        if (is_null($existDepartment)) {
            throw new Exception("El departamento seleccionado no existe");
        }

        if (empty($name)) {
            throw new Exception("El nombre es obligatorio");
        }

        if (empty($duration)) {
            throw new Exception("La duración es obligatoria");
        }

        if (!intval($duration)) {
            throw new Exception("Error al recibir la información de la duración");
        }

        if (empty($price)) {
            throw new Exception("El precio es obligatorio");
        }

        if (!floatval($price)) {
            throw new Exception("Error al recibir la información del precio");
        }

        return new self(
            $idDepartment,
            $name,
            $duration,
            $price,
            $description,
        );
    }

}
