<?php

declare(strict_types=1);

namespace Axcherednikov\Centrifugo\Token;

interface TokenPayloadInterface
{
    public function toArray(): array;
}
