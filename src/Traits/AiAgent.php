<?php

namespace Iankibet\SdpAi\Traits;

trait AiAgent
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
        $this->model = array_values($this->models)[0];
    }

    public function formatAiMessages(array $messages, string $userMessage = null): array
    {
        $formattedMessages = [];
        foreach ($messages as $message) {
            if (is_array($message)) {
                $formattedMessages[] = [
                    'role' => $message['role'] ?? 'system',
                    'content' => $message['content'] ?? $message['message'] ?? ''
                ];
            } else {
                $formattedMessages[] = [
                    'role' => 'system',
                    'content' => $message
                ];
            }
        }
        if ($userMessage) {
            $formattedMessages[] = [
                'role' => 'user',
                'content' => $userMessage
            ];
        }
        return $formattedMessages;
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
}
