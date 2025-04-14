<?php

namespace Iankibet\SdpAi;

use Illuminate\Support\ServiceProvider;

class SdpAiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('sdpai', function ($app) {
            return new SdpAiManager($app);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/sdp-ai.php' => config_path('sdp-ai.php'),
        ], 'sdpai-config');
    }
}
