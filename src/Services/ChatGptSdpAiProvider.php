<?php

namespace Iankibet\SdpAi\Services;

use Iankibet\SdpAi\Contracts\SdpAiProvider;
use Iankibet\SdpAi\Traits\AiAgent;
use Illuminate\Support\Facades\Http;

class ChatGptSdpAiProvider implements SdpAiProvider
{
    use AiAgent;


    public function generate($messages, $userMessage = null): string
    {
        $messages = $this->formatAiMessages($messages, $userMessage);
        $payload = [
            'model' => $this->model,
            'messages'=>$messages
        ];
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/chat/completions", $payload);

        return $response->json('choices.0.message.content') ?? 'Error generating content';
    }
}
