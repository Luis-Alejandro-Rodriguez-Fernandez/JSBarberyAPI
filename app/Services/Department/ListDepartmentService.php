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

class ListDepartmentService extends Service
{
    protected DepartmentRepository $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(): AnonymousResourceCollection
    {
        $departmentsList = $this->repository->list();

        return DepartmentResource::collection($departmentsList);
    }
}
