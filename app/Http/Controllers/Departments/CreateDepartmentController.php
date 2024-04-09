<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use App\Services\Department\CreateDepartmentService;
use App\ValueObjects\Departments\CreatableDepartment;
use Exception;
use Illuminate\Http\JsonResponse;

class CreateDepartmentController extends Controller
{
    protected CreateDepartmentService $departmentService;
    public function __construct(CreateDepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $name = request()->name;

            $creatableDepartment = CreatableDepartment::create($name);

            $department = $this->departmentService->create($creatableDepartment);

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $department, "Guardado correctamente");
    }
}
