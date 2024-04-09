<?php

namespace App\ValueObjects\Generals;

use Exception;

class IdObject
{

    protected int $id;

    private function __construct(int $id)
    {
        $this->id = $id;
    }

    public function value(): int
    {
        return $this->id;
    }

    /**
     * @throws Exception
     */
    public static function create($id): self
    {
            if (is_null($id)) {
                throw new Exception("El identificador es un dato obligatorio");
            }

            return new self($id);
    }
}
