<?php

namespace Iankibet\SdpAi\Services;

use Iankibet\SdpAi\Contracts\SdpAiProvider;
use Illuminate\Support\Facades\Http;

class XaiSdpAiProvider implements SdpAiProvider
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;
    protected array $models;

    public function __construct(array $config)
    {
        $this->apiKey = $config['api_key'];
        $this->baseUrl = $config['base_url'];
        $this->models = $config['models'];
        $this->model = $this->models['grok'] ?? 'grok'; // Default model
    }

    public function setModel(string $model): self
    {
        $this->model = $this->models[$model] ?? $model;
        return $this;
    }
    public function model(string $model): self
    {
        return $this->setModel($model);
    }

    public function generate(string $prompt, $systemMessages = []): string
    {
        $messages = [
            [
                'role' => 'user',
                'content' => $prompt
            ]
        ];
        foreach($systemMessages as $message){
            $messages[] = [
                'role' => 'system',
                'content' => $message
            ];
        }
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
            throw new \Exception('Error generating content');
        }
    }

    public function complete($messages = []): string
    {
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
            throw new \Exception('Error generating content');
        }
    }
}
