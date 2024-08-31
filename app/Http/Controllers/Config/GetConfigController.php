<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Repositories\Config\ConfigRepository;
use App\Resources\Config\ConfigResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetConfigController extends Controller
{
    private ConfigRepository $repository;

    public function __construct(
        ConfigRepository $repository,
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {

            $configData = $this->repository->getConfig();

            return $this->generalMethods()->responseToApp(1, new ConfigResource($configData));

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, $exception->getMessage());
        }
    }
}
