<?php

namespace App\Services\Department;

use App\Models\Departments\Department;
use App\Repositories\Departments\DepartmentRepository;
use App\Resources\Department\DepartmentResource;
use App\Services\Service;
use App\ValueObjects\Departments\CreatableDepartment;
use Exception;

class CreateDepartmentService extends Service
{
    protected DepartmentRepository $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function create(CreatableDepartment $creatableDepartment): DepartmentResource
    {
        $department = $this->repository->create($creatableDepartment);

        return new DepartmentResource($department);
    }
}
