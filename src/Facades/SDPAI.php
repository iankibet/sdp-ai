<?php

namespace Iankibet\SdpAi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Iankibet\SdpAi\Contracts\SdpAiProvider provider(string $name)
 * @method static \Iankibet\SdpAi\Contracts\SdpAiProvider model(string $model)
 * @method static string getDefaultDriver()
 */

class SDPAI extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'sdpai';
    }
}
