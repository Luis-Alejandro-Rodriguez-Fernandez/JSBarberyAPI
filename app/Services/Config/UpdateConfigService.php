<?php

namespace App\Services\Config;

use App\Models\Config\Config;
use App\Repositories\Config\ConfigRepository;
use App\ValueObjects\Config\EditableConfig;
use Exception;

class  UpdateConfigService
{

    protected ConfigRepository $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @throws Exception
     */
    public function update(EditableConfig $configData): Config
    {
        $config = $this->configRepository->getConfig();

        $config->email = $configData->getEmail();
        $config->phone = $configData->getPhone();
        $config->first_journal = $configData->getFirstJournal();
        $config->second_journal = $configData->getSecondJournal();
        $config->disabled_days = $configData->getDisabledDays();
        $config->instagram = $configData->getInstagram();
        $config->tiktok = $configData->getTiktok();

        if (!$config->save()) {
            throw new Exception("No se puedo guardar los cambios a la configuración");
        }

        return $config;
    }

}
