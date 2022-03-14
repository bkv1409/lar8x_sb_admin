<?php

namespace Bkv1409\SystemConfig;
use Bkv1409\SystemConfig\Models\SystemConfig as SystemConfigModel;

class SystemConfig
{
    // Build wonderful things
    public static function getConfigTypes()
    {
        return SystemConfigModel::$SYSTEM_CONFIG_TYPES;
    }
}
