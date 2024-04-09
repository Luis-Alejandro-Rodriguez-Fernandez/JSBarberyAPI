<?php

namespace App\Services\Config;

use App\Repositories\Config\ConfigRepository;

class  UpdateConfigService
{

    protected ConfigRepository $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function update()
    {
//            $this->configRepository->
    }
}
