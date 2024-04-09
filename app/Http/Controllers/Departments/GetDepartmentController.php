<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use App\Services\Department\GetDepartmentService;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Http\JsonResponse;

class GetDepartmentController extends Controller
{
    protected GetDepartmentService $departmentService;

    public function __construct(GetDepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $id = IdObject::create(request()->id)->value();

            $department = $this->departmentService->find($id);

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, $exception->getMessage());
        }

       return $this->generalMethods()->responseToApp(1, $department);
    }
}
