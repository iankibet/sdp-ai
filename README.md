
# SDP-AI

A Laravel package for integrating multiple AI providers (ChatGPT, Claude, DeepSeek, Xai) using a simple, unified API.

---

## Features

- Easy switching between AI providers.
- Support for ChatGPT, Claude, DeepSeek, and Xai.
- Laravel-ready with Service Provider and Facade.
- Extendable and customizable.

---

## Installation

```bash
composer require iankibet/sdp-ai
```

> Replace `your-vendor-name` with your actual composer namespace.

---

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="SdpAi\SdpAiServiceProvider" --tag="config"
```

This will publish `config/sdp-ai.php` where you can configure API keys and default providers.

Example `config/sdp-ai.php`:

```php
return [
    'default' => 'chatgpt',
    
    'providers' => [
        'chatgpt' => [
            'api_key' => env('CHATGPT_API_KEY'),
        ],
        'claude' => [
            'api_key' => env('CLAUDE_API_KEY'),
        ],
        'deepseek' => [
            'api_key' => env('DEEPSEEK_API_KEY'),
        ],
        'xai' => [
            'api_key' => env('XAI_API_KEY'),
        ],
    ],
];
```

---

## Usage

Use the provided `SDPAI` facade:

```php
use SdpAi\Facades\SDPAI;

// Send a message using the default provider
$response = SDPAI::ask('Hello, how are you?');

// Switch provider dynamically
$response = SDPAI::setProvider('claude')->ask('Tell me a joke.');
```

Or via Dependency Injection:

```php
use SdpAi\SdpAiManager;

class MyController
{
    public function handle(SdpAiManager $sdpAi)
    {
        $response = $sdpAi->setProvider('deepseek')->ask('Explain Quantum Physics.');
    }
}
```

---

## Extending

You can create your own provider by implementing the `SdpAi\Contracts\SdpAiProvider` interface and binding it in the `config/sdp-ai.php`.

---

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
