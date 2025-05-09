<?php

namespace Iankibet\SdpAi\Services;

use Iankibet\SdpAi\Contracts\SdpAiProvider;
use Iankibet\SdpAi\Traits\AiAgent;
use Illuminate\Support\Facades\Http;

class XaiSdpAiProvider implements SdpAiProvider
{
    use AiAgent;

    public function generate(array $messages, $userMessage = null): string
    {
        $messages = $this->formatAiMessages($messages, $userMessage);
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/chat/completions", [
            'model' => $this->model,
            'stream' => false,
            'messages' => $messages,
        ]);
        if($response->json('choices')){
            return $response->json('choices.0.message.content');
        }else{
            $json = $response->json();
            throw new \Exception('Error generating content: ' . json_encode($json));
        }
    }
}
