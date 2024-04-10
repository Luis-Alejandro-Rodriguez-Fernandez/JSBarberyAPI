<?php

namespace App\Services\Department;

use App\Models\Departments\Department;
use App\Repositories\Departments\DepartmentRepository;
use App\Resources\Department\DepartmentResource;
use App\Services\Service;
use App\ValueObjects\Departments\CreatableService;
use App\ValueObjects\Departments\EditableService;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetDepartmentService extends Service
{
    protected DepartmentRepository $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function find(int $id): DepartmentResource
    {
        $department = $this->repository->find($id);

        if (is_null($department)) {
            throw new Exception("Departamento no encontrado");
        }

        return new DepartmentResource($department);
    }
}
