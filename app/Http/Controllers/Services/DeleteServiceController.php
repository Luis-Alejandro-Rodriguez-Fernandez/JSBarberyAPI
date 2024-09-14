<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Services\Service\DeleteServiceService;
use App\Services\Service\GetServiceService;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Http\JsonResponse;

class DeleteServiceController extends Controller
{

    protected DeleteServiceService $deleteServiceService;

    public function __construct(
        DeleteServiceService               $deleteServiceService,
        private readonly GetServiceService $getServiceService,
    )
    {
        $this->deleteServiceService = $deleteServiceService;
    }

    public function __invoke(): JsonResponse
    {
        $requestId = request()->id;

        try {
            $id = IdObject::create($requestId)->value();

            $this->getServiceService->find($id);

            $this->deleteServiceService->delete($id);
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, null, "Eliminado correctamente");
    }
}
