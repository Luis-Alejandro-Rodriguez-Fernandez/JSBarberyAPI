<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Services\Service\GetServiceService;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Http\JsonResponse;

class GetServiceController extends Controller
{
    protected GetServiceService $getServiceService;

    public function __construct(GetServiceService $getServiceService)
    {
        $this->getServiceService = $getServiceService;
    }

    public function __invoke(): JsonResponse
    {
        $requestId = request()->id;

        try {
            $id = IdObject::create($requestId)->value();
            $service = $this->getServiceService->find($id);

        }catch (Exception $exception)
        {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $service);
    }
}
