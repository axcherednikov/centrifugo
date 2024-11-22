<?php

declare(strict_types=1);

namespace Axcherednikov\Centrifugo\Token;

interface TokenGeneratorInterface
{
    public function generateConnectionToken(ConnectionTokenPayload $payload): string;
    public function generateSubscribeToken(SubscribeTokenPayload $payload): string;
}
