<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Services\Service\UpdateServiceService;
use App\ValueObjects\Generals\IdObject;
use App\ValueObjects\Services\EditableService;
use Exception;
use Illuminate\Http\JsonResponse;

class UpdateServiceController extends Controller
{
    protected UpdateServiceService $serviceService;

    public function __construct(UpdateServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $id = IdObject::create(request()->id)->value();
            $name = request()->name;
            $idDepartment = request()->id_department;
            $description = request()->description ?? "";
            $duration = request()->duration;
            $price = request()->price;

            $newData = EditableService::create($id, $name, $idDepartment, $duration, $price, $description);

            $service = $this->serviceService->update($id, $newData);

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $service, "Guardado correctamente");
    }
}
