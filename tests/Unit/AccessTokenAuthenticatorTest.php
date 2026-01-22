<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\PendingRequest;
use Saloon\Http\Request;

it('adds Authorization Bearer header to request', function (): void {
    $authenticator = new AccessTokenAuthenticator('token123');

    $connector = new class extends Connector
    {
        public function resolveBaseUrl(): string
        {
            return 'https://example.com';
        }
    };

    $request = new class extends Request
    {
        protected Method $method = Method::GET;

        public function resolveEndpoint(): string
        {
            return '/';
        }
    };

    $pendingRequest = new PendingRequest(
        connector: $connector,
        request: $request
    );

    $authenticator->set($pendingRequest);

    expect($pendingRequest->headers()->get('Authorization'))
        ->toBe('Bearer token123');
});
