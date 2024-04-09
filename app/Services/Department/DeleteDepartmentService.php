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
    public function delete(int $id): bool
    {
        $isDeleted = $this->repository->delete($id);

        if (!$isDeleted) {
            throw new Exception("Un error ha impedido eliminar el deparatamento, intentelo más tarde.");
        }

        return true;
    }
}
