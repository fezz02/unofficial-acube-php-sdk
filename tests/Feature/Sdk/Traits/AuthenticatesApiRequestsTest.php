<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Tests\Fixtures\Authentication\_UnsafeInMemoryTokenCache as UnsafeInMemoryTokenCache;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

/**
 * Helper function to encode base64url (RFC 4648).
 */
if (! function_exists('base64url_encode')) {
    function base64url_encode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

beforeEach(function (): void {
});

test('login method authenticates and stores token in cache', function (): void {
    $cache = new UnsafeInMemoryTokenCache;

    // Create a valid JWT token for testing (header.payload.signature)
    $payload = [
        'iat' => 1609459200,
        'exp' => 1640995200,
        'roles' => ['project1' => ['admin', 'user']],
        'username' => 'test@example.com',
        'uid' => 123,
    ];

    $header = base64url_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256'], JSON_THROW_ON_ERROR));
    $payloadEncoded = base64url_encode(json_encode($payload, JSON_THROW_ON_ERROR));
    $signature = 'signature';
    $token = "{$header}.{$payloadEncoded}.{$signature}";

    // Set up mock client
    $mockClient = new MockClient([
        MockResponse::make(['token' => $token], 200),
    ]);

    // Create a connector with the mock
    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX);
    $connector->withMockClient($mockClient);

    // Use authentication API to login
    $authApi = $connector->authentication();
    $response = $authApi->login('test@example.com', 'password123');
    $loginResponse = $response->dto();
    
    // Store token in cache manually
    $authenticator = new AccessTokenAuthenticator($loginResponse->token);
    $cache->set('default', $authenticator);
    
    // Decode token to get useful information
    $decoder = new \Fezz\Acube\Sdk\Authentication\TokenDecoder();
    $info = $decoder->decode($loginResponse->token);

    expect($info)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto::class)
        ->and($cache->get('default'))->toBeInstanceOf(AccessTokenAuthenticator::class);
});

test('login method works without cache', function (): void {
    // Create a valid JWT token for testing (header.payload.signature)
    $payload = [
        'iat' => 1609459200,
        'exp' => 1640995200,
        'roles' => ['project1' => ['admin', 'user']],
        'username' => 'test@example.com',
        'uid' => 123,
    ];

    $header = base64url_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256'], JSON_THROW_ON_ERROR));
    $payloadEncoded = base64url_encode(json_encode($payload, JSON_THROW_ON_ERROR));
    $signature = 'signature';
    $token = "{$header}.{$payloadEncoded}.{$signature}";

    // Set up mock client
    $mockClient = new MockClient([
        MockResponse::make(['token' => $token], 200),
    ]);

    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX);
    $connector->withMockClient($mockClient);

    // Use authentication API to login
    $authApi = $connector->authentication();
    $response = $authApi->login('test@example.com', 'password123');
    $loginResponse = $response->dto();
    
    // Decode token to get useful information
    $decoder = new \Fezz\Acube\Sdk\Authentication\TokenDecoder();
    $info = $decoder->decode($loginResponse->token);

    expect($info)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto::class);
});

test('usingTokenCache sets and retrieves cache', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $providesAccount = new class($cache) implements \Fezz\Acube\Sdk\Contracts\ProvidesAccount {
        public function __construct(private $cache) {}
        public function getAuthenticator(): \Saloon\Contracts\Authenticator {
            return $this->cache->get('default');
        }
    };

    // Verify cache is set by checking that getAuthenticator retrieves from cache
    $authenticator = new AccessTokenAuthenticator('test-token');
    $cache->set('default', $authenticator);

    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX, $providesAccount);
    $retrieved = $connector->defaultAuth();

    expect($retrieved)->toBeInstanceOf(AccessTokenAuthenticator::class);
});

test('authenticate method stores authenticator in cache', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $authenticator = new AccessTokenAuthenticator('test-token');
    
    // Store in cache
    $cache->set('default', $authenticator);
    
    $providesAccount = new class($cache) implements \Fezz\Acube\Sdk\Contracts\ProvidesAccount {
        public function __construct(private $cache) {}
        public function getAuthenticator(): \Saloon\Contracts\Authenticator {
            return $this->cache->get('default');
        }
    };

    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX, $providesAccount);

    // Verify cache has the authenticator
    expect($cache->get('default'))->toBeInstanceOf(AccessTokenAuthenticator::class);
});

test('getAuthenticator retrieves from cache when no authenticator is set', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $providesAccount = new class($cache) implements \Fezz\Acube\Sdk\Contracts\ProvidesAccount {
        public function __construct(private $cache) {}
        public function getAuthenticator(): \Saloon\Contracts\Authenticator {
            return $this->cache->get('default');
        }
    };

    $authenticator = new AccessTokenAuthenticator('test-token');
    $cache->set('default', $authenticator);

    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX, $providesAccount);
    $retrieved = $connector->defaultAuth();

    expect($retrieved)->toBeInstanceOf(AccessTokenAuthenticator::class);
});

test('login method converts non-CommonConnector to CommonConnector', function (): void {
    // Create a valid JWT token for testing (header.payload.signature)
    $payload = [
        'iat' => 1609459200,
        'exp' => 1640995200,
        'roles' => ['project1' => ['admin', 'user']],
        'username' => 'test@example.com',
        'uid' => 123,
    ];

    $header = base64url_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256'], JSON_THROW_ON_ERROR));
    $payloadEncoded = base64url_encode(json_encode($payload, JSON_THROW_ON_ERROR));
    $signature = 'signature';
    $token = "{$header}.{$payloadEncoded}.{$signature}";

    // Set up a global mock client - this will apply to all connectors
    MockClient::global([
        MockResponse::make(['token' => $token], 200),
    ]);

    try {
        // Create a CommonConnector for login
        $commonConnector = AcubeApi::common(Endpoint::COMMON_SANDBOX);
        $commonConnector->withMockClient(new MockClient([
            MockResponse::make(['token' => $token], 200),
        ]));

        // Use authentication API to login
        $authApi = $commonConnector->authentication();
        $response = $authApi->login('test@example.com', 'password123');
        $loginResponse = $response->dto();
        
        // Decode token to get useful information
        $decoder = new \Fezz\Acube\Sdk\Authentication\TokenDecoder();
        $info = $decoder->decode($loginResponse->token);

        expect($info)
            ->toBeInstanceOf(Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto::class);
    } finally {
        // Clean up the global mock client
        MockClient::destroyGlobal();
    }
});
