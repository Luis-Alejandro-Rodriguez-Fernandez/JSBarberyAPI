<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use App\Services\Department\UpdateDepartmentService;
use App\ValueObjects\Departments\EditableDepartment;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Http\JsonResponse;

class UpdateDepartmentController extends Controller
{
    protected UpdateDepartmentService $departmentService;

    public function __construct(UpdateDepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $id = IdObject::create(request()->id)->value();
            $name = request()->name;

            $newData = EditableDepartment::create($id, $name);

            $department = $this->departmentService->update($id, $newData);

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $department, "Guardado correctamente");
    }
}
