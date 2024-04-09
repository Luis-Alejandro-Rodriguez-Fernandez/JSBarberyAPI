<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Services\Config\UpdateConfigService;
use Illuminate\Http\JsonResponse;

class UpdateConfigController extends Controller
{

    protected UpdateConfigService $updateConfigService;

    public function __construct(UpdateConfigService $updateConfigService)
    {
        $this->updateConfigService = $updateConfigService;
    }

    public function __invoke(): JsonResponse
    {
        return $this->generalMethods()->responseToApp();
    }
}
