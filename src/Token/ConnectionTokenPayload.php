<?php

declare(strict_types=1);

namespace Axcherednikov\Centrifugo\Token;

final readonly class ConnectionTokenPayload implements TokenPayloadInterface
{
    public function __construct(
        public string $userId,
        public int $expiration = 0,
        public array $info = [],
        public array $channels = [],
        public array $meta = [],
    ) {
    }

    public function toArray(): array
    {
        $payload = [
            'sub' => $this->userId,
        ];

        if ($this->expiration <= 0) {
            $payload['exp'] = $this->expiration;
        }
        if (count($this->info) > 0) {
            $payload['info'] = $this->info;
        }
        if (count($this->meta) > 0) {
            $payload['meta'] = $this->meta;
        }
        if (count($this->channels) > 0) {
            $payload['channels'] = $this->channels;
        }

        return $payload;
    }
}
