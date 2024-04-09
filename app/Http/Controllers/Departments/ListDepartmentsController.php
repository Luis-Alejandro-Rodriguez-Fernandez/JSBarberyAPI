<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use App\Services\Department\ListDepartmentService;
use Exception;
use Illuminate\Http\JsonResponse;

class ListDepartmentsController extends Controller
{
    protected ListDepartmentService $departmentService;

    public function __construct(ListDepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function __invoke(): JsonResponse
    {
        try {

            $departmentsList = $this->departmentService->list();

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $departmentsList);
    }
}
