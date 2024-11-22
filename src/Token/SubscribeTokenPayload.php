<?php

declare(strict_types=1);

namespace Axcherednikov\Centrifugo\Token;

final readonly class SubscribeTokenPayload implements TokenPayloadInterface
{
    public function __construct(
        public string $channelName,
        public string $userId,
        /** @var array<string,mixed> */
        public array $info = [],
        public int $expiration = 0,
    ) {
    }

    public function toArray(): array
    {
        $payload = [
            'sub' => $this->userId,
            'channel' => $this->channelName,
        ];

        if (count($this->info) > 0) {
            $payload['info'] = $this->info;
        }
        if ($this->expiration > 0) {
            $payload['exp'] = $this->expiration;
        }

        return $payload;
    }
}
