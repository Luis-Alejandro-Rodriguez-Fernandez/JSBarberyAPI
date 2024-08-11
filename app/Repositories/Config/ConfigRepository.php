<?php

namespace App\Repositories\Config;

use App\Models\Config\Config;

class ConfigRepository
{
    public function getConfig(): Config
    {
        return Config::query()->get()->first();
    }
}
