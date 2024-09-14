<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use App\Services\Department\DeleteDepartmentService;
use App\Services\Department\GetDepartmentService;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Http\JsonResponse;

class DeleteDepartmentController extends Controller
{
    protected DeleteDepartmentService $departmentService;

    public function __construct(
        DeleteDepartmentService $departmentService,
        private readonly GetDepartmentService $getDepartmentService,
    )
    {
        $this->departmentService = $departmentService;
    }

    /**
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        try {
            $id = IdObject::create(request()->id)->value();

            $this->getDepartmentService->find($id);

            $isDeleted = $this->departmentService->delete($id);

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $isDeleted, "Eliminado correctamente");
    }

}
