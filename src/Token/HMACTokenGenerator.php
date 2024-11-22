<?php

declare(strict_types=1);

namespace Axcherednikov\Centrifugo\Token;

final readonly class HMACTokenGenerator implements TokenGeneratorInterface
{
    public function __construct(
        private string $secret,
    ) {
    }

    public function generateConnectionToken(ConnectionTokenPayload $payload): string
    {
        return $this->encodeJWT($payload);
    }

    public function generateSubscribeToken(SubscribeTokenPayload $payload): string
    {
        return $this->encodeJWT($payload);
    }

    private function generateJWTHeader(): string
    {
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256',
        ];

        return $this->urlSafeBase64Encode(json_encode($header));
    }

    private function urlSafeBase64Encode(string $data): string
    {
        return str_replace('=', '', strtr(base64_encode($data), '+/', '-_'));
    }

    private function sign(string $data, string $key): string
    {
        return hash_hmac('sha256', $data, $key, true);
    }

    public function encodeJWT(TokenPayloadInterface $payload): string
    {
        $segments = [];

        $segments[] = $this->generateJWTHeader();
        $segments[] = $this->urlSafeBase64Encode(json_encode($payload->toArray()));
        $signature = $this->sign(implode('.', $segments), $this->secret);
        $segments[] = $this->urlSafeBase64Encode($signature);

        return implode('.', $segments);
    }
}
