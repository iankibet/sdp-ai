<?php

namespace Iankibet\SdpAi;

use Iankibet\SdpAi\Contracts\SdpAiProvider;
use Illuminate\Support\Manager;

class SdpAiManager extends Manager
{
    protected function createChatgptDriver()
    {
        return new \Iankibet\SdpAi\Services\ChatGptSdpAiProvider(
            config('sdp-ai.providers.chatgpt')
        );
    }

    protected function createXaiDriver()
    {
        return new \Iankibet\SdpAi\Services\XaiSdpAiProvider(
            config('sdp-ai.providers.xai')
        );
    }

    protected function createClaudeDriver()
    {
        return new \Iankibet\SdpAi\Services\ClaudeSdpAiProvider(
            config('sdp-ai.providers.claude')
        );
    }

    protected function createDeepseekDriver()
    {
        return new \Iankibet\SdpAi\Services\DeepSeekSdpAiProvider(
            config('sdp-ai.providers.deepseek')
        );
    }

    public function provider(string $name): SdpAiProvider
    {
        return $this->driver($name);
    }

    public function getDefaultDriver()
    {
        return config('sdp-ai.default_provider');
    }

    public function model(string $model): SdpAiProvider
    {
        return $this->driver()->setModel($model);
    }
}
