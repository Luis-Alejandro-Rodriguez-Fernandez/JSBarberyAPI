<?php

namespace App\Services\Department;

use App\Models\Departments\Department;
use App\Repositories\Departments\DepartmentRepository;
use App\Resources\Department\DepartmentResource;
use App\Services\Service;
use App\ValueObjects\Departments\EditableDepartment;
use Exception;

class UpdateDepartmentService extends Service
{
    protected DepartmentRepository $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function update(int $id, EditableDepartment $newDepartmentData): DepartmentResource
    {
        $department = Department::query()->find($id);

        if (is_null($department)) {
            throw new Exception("No se ha encontrado el departamento");
        }

        $department->updateModel($newDepartmentData);

        return new DepartmentResource($department);
    }
}
