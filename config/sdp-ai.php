<?php

return [
    'default_provider' => env('SDPAI_DEFAULT_PROVIDER', 'chatgpt'),
    'providers' => [
        'chatgpt' => [
            'api_key' => env('SDPAI_CHATGPT_API_KEY'),
            'base_url' => 'https://api.openai.com/v1',
            'models' => [
                'gpt-40' => 'gpt-4',
                'gpt-35' => 'gpt-3.5-turbo',
            ],
        ],
        'xai' => [
            'api_key' => env('SDPAI_XAI_API_KEY'),
            'base_url' => 'https://api.x.ai/v1', // Hypothetical URL, adjust when xAI API is available
            'models' => [
                'grok' => 'grok-2-latest',
            ],
        ],
        'claude' => [
            'api_key' => env('SDPAI_CLAUDE_API_KEY'),
            'base_url' => 'https://api.anthropic.com/v1', // Adjust based on Anthropic’s API
            'models' => [
                'claude-3' => 'claude-3-sonnet-20240229',
            ],
        ],
        'deepseek' => [
            'api_key' => env('SDPAI_DEEPSEEK_API_KEY'),
            'base_url' => 'https://api.deepseek.com/v1', // Hypothetical, adjust as needed
            'models' => [
                'deepseek-v2' => 'deepseek-v2',
            ],
        ],
    ],
];
