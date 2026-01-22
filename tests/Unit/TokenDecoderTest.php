<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto;
use Fezz\Acube\Sdk\Authentication\TokenDecoder;
use Fezz\Acube\Sdk\Exceptions\Authentication\InvalidTokenFormatException;

test('decodes valid jwt token', function (): void {
    $decoder = new TokenDecoder;

    // Create a valid JWT token (header.payload.signature)
    $payload = [
        'iat' => 1609459200,
        'exp' => 1640995200,
        'roles' => ['project1' => ['admin', 'user']],
        'username' => 'test@example.com',
        'uid' => 123,
    ];

    $header = base64_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
    $payloadEncoded = base64_encode(json_encode($payload));
    $signature = 'signature';
    $token = "{$header}.{$payloadEncoded}.{$signature}";

    $result = $decoder->decode($token);

    expect($result)
        ->toBeInstanceOf(AuthenticationUsefulInformationDto::class)
        ->and($result->iat)->toBe(1609459200)
        ->and($result->exp)->toBe(1640995200)
        ->and($result->username)->toBe('test@example.com')
        ->and($result->uid)->toBe(123)
        ->and($result->roles)->toBe(['project1' => ['admin', 'user']]);
});

test('throws exception for invalid token format with wrong number of parts', function (): void {
    $decoder = new TokenDecoder;

    expect(fn (): AuthenticationUsefulInformationDto => $decoder->decode('invalid.token'))
        ->toThrow(InvalidTokenFormatException::class, 'Token is not stored in valid JWT format.');
});

test('throws exception for invalid base64 payload', function (): void {
    $decoder = new TokenDecoder;

    $token = 'header.invalid-base64!.signature';

    expect(fn (): AuthenticationUsefulInformationDto => $decoder->decode($token))
        ->toThrow(InvalidTokenFormatException::class, 'Second part of Token does not contain a valid payload. Could not base64 decode.');
});

test('throws exception for invalid json payload', function (): void {
    $decoder = new TokenDecoder;

    $header = base64_encode('header');
    $payloadEncoded = base64_encode('invalid json {');
    $signature = 'signature';
    $token = "{$header}.{$payloadEncoded}.{$signature}";

    expect(fn (): AuthenticationUsefulInformationDto => $decoder->decode($token))
        ->toThrow(InvalidTokenFormatException::class, 'Token payload is not valid JSON');
});

test('throws exception for missing required field', function (): void {
    $decoder = new TokenDecoder;

    $payload = [
        'iat' => 1609459200,
        'exp' => 1640995200,
        'roles' => ['project1' => ['admin']],
        'username' => 'test@example.com',
        // Missing 'uid'
    ];

    $header = base64_encode(json_encode(['typ' => 'JWT']));
    $payloadEncoded = base64_encode(json_encode($payload));
    $signature = 'signature';
    $token = "{$header}.{$payloadEncoded}.{$signature}";

    expect(fn (): AuthenticationUsefulInformationDto => $decoder->decode($token))
        ->toThrow(InvalidTokenFormatException::class, 'Token payload is missing required field: uid');
});

test('converts uid from string to int', function (): void {
    $decoder = new TokenDecoder;

    $payload = [
        'iat' => 1609459200,
        'exp' => 1640995200,
        'roles' => ['project1' => ['admin']],
        'username' => 'test@example.com',
        'uid' => '123', // String uid
    ];

    $header = base64_encode(json_encode(['typ' => 'JWT']));
    $payloadEncoded = base64_encode(json_encode($payload));
    $signature = 'signature';
    $token = "{$header}.{$payloadEncoded}.{$signature}";

    $result = $decoder->decode($token);

    expect($result->uid)->toBeInt()->toBe(123);
});
