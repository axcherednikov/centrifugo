<?php

declare(strict_types=1);

namespace Axcherednikov\Centrifugo\Config;

final class CentrifugoConfig
{
    public function __construct(
        private readonly string $url,
        private readonly string $apiKey,
        private readonly string $secret,
        private ?string $certificatePath = null,
        private ?string $caPath = null,
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

    public function getCertificatePath(): ?string
    {
        return $this->certificatePath;
    }

    public function setCertificatePath(?string $certificatePath): self
    {
        $this->certificatePath = $certificatePath;

        return $this;
    }

    public function getCaPath(): ?string
    {
        return $this->caPath;
    }

    public function setCaPath(?string $caPath): self
    {
        $this->caPath = $caPath;

        return $this;
    }
}
