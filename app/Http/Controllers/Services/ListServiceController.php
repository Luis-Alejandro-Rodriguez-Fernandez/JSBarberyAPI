<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Services\Service\GetServiceService;
use App\Services\Service\ListServiceService;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Http\JsonResponse;

class ListServiceController extends Controller
{

    protected ListServiceService $listServiceService;

    public function __construct(ListServiceService $listServiceService)
    {
        $this->listServiceService = $listServiceService;
    }

    public function __invoke(): JsonResponse
    {
        try {

            $services = $this->listServiceService->list();

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, [], $exception->getMessage());
        }

        return $this->generalMethods()->responseToApp(1, $services);
    }
}
