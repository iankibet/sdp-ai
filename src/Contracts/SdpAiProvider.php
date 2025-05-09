<?php

namespace Iankibet\SdpAi\Contracts;

interface SdpAiProvider
{
    public function setModel(string $model): self;
    public function model(string $model): self;
    public function generate(array $messages, string $userMessage = null): string;
}
