<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Services\Service\CreateServiceService;
use App\ValueObjects\Services\CreatableService;
use Exception;
use Illuminate\Http\JsonResponse;

class CreateServiceController extends Controller
{

    protected CreateServiceService $serviceService;
    public function __construct(CreateServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function __invoke(): JsonResponse
    {

        try {
            $idDepartment = request()->id_department;
            $name = request()->name;
            $description = request()->description ?? "";
            $duration = request()->duration;
            $price = request()->price;

            $creatableService = CreatableService::create(
                $idDepartment,
                $name,
                $duration,
                $price,
                $description,
            );

            $service = $this->serviceService->create($creatableService);

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $service, "Guardado correctamente");
    }
}
