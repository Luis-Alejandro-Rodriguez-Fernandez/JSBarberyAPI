<?php

namespace App\Services\Service;

use App\Repositories\Service\ServiceRepository;
use Exception;

class DeleteServiceService
{
    protected ServiceRepository $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $isDeleted = $this->repository->delete($id);

        if (!$isDeleted) {
            throw new Exception("Un error ha impedido eliminar el servicio, intentelo más tarde.");
        }
    }
}
