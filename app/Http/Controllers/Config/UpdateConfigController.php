<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Resources\Config\ConfigResource;
use App\Services\Config\UpdateConfigService;
use App\ValueObjects\Config\EditableConfig;
use App\ValueObjects\Generals\IdObject;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateConfigController extends Controller
{

    protected UpdateConfigService $updateConfigService;

    public function __construct(UpdateConfigService $updateConfigService)
    {
        $this->updateConfigService = $updateConfigService;
    }

    /**
     * @throws Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {

            $configData = EditableConfig::create(
                $request
            );

            $updatedConf = $this->updateConfigService->update($configData);

            return $this->generalMethods()->responseToApp(1, new ConfigResource($updatedConf));
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, $exception->getMessage());
        }
    }
}
