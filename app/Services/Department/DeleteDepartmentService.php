<?php

namespace App\Services\Department;

use App\Repositories\Departments\DepartmentRepository;
use App\Services\Service;
use Exception;

class DeleteDepartmentService extends Service
{
    protected DepartmentRepository $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function delete(?int $id): bool
    {
        $isDeleted = $this->repository->delete($id);

        if (!$isDeleted) {
            throw new Exception("Un error ha impedido eliminar el deparatamento, intentelo más tarde.");
        }

        return true;
    }
}
