<?php

declare(strict_types=1);

final readonly class CentrifugoConfig
{
    public function __construct(
        private string $url,
        private string $apiKey,
        private string $secret,
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }
}
