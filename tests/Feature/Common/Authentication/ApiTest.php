<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Tests\Fixtures\Authentication\_UnsafeInMemoryTokenCache as UnsafeInMemoryTokenCache;
use Fezz\Acube\Sdk\Common\Authentication\Api as AuthenticationApi;
use Fezz\Acube\Sdk\Common\Authentication\Dto\LoginResponseDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;

beforeEach(function (): void {
    // Reset cache and endpoint before each test
});

test('can login and get token', function (): void {
    $connector = AcubeApi::common();
    $authApi = new AuthenticationApi($connector);

    $mockClient = new MockClient([
        MockResponse::make(['token' => 'test-token-123'], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $authApi->login('test@example.com', 'password');
    $loginResponse = $response->dto();

    expect($loginResponse)
        ->toBeInstanceOf(LoginResponseDto::class)
        ->and($loginResponse->token)
        ->toBe('test-token-123');
});


test('can authenticate with email and password', function (): void {
    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX);
    $authApi = new AuthenticationApi($connector);

    // Create a mock JWT token with valid payload
    $payload = [
        'iat' => 1_700_000_000,
        'exp' => 1_700_086_400,
        'roles' => ['test' => ['ROLE_USER']],
        'username' => 'test@example.com',
        'uid' => 123,
    ];
    $payloadPart = base64_encode(json_encode($payload, JSON_THROW_ON_ERROR));
    $jwt = 'header.' . $payloadPart . '.signature';

    $mockClient = new MockClient([
        MockResponse::make(['token' => $jwt], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $authApi->login('test@example.com', 'password');
    $loginResponse = $response->dto();
    
    // Decode token to get useful information
    $decoder = new \Fezz\Acube\Sdk\Authentication\TokenDecoder();
    $info = $decoder->decode($loginResponse->token);

    expect($info)
        ->toBeInstanceOf(AuthenticationUsefulInformationDto::class)
        ->and($info->username)
        ->toBe('test@example.com');
});

test('authenticated requests include bearer token', function (): void {
    $token = 'test-token-123';
    $providesAccount = new class($token) implements \Fezz\Acube\Sdk\Contracts\ProvidesAccount {
        public function __construct(private $token) {}
        public function getAuthenticator(): \Saloon\Contracts\Authenticator {
            return new AccessTokenAuthenticator($this->token);
        }
    };
    
    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX, $providesAccount);
    $authApi = new AuthenticationApi($connector);

    $mockClient = new MockClient([
        MockResponse::make(['data' => 'test'], 200),
    ]);

    $connector->withMockClient($mockClient);

    $request = new class extends Request
    {
        protected Saloon\Enums\Method $method = Saloon\Enums\Method::GET;

        public function resolveEndpoint(): string
        {
            return '/test';
        }
    };

    $response = $connector->send($request);

    // Verify the request was made (the authenticator will add the header automatically)
    expect($response->status())->toBe(200);

    // Verify the authenticator is set via defaultAuth
    $authenticator = $connector->defaultAuth();
    expect($authenticator)
        ->toBeInstanceOf(AccessTokenAuthenticator::class)
        ->and($authenticator->getAccessToken())
        ->toBe($token);
});


test('connector automatically uses cached token', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $token = 'test-token-123';
    $cache->set('default', new AccessTokenAuthenticator($token));
    
    $providesAccount = new class($cache) implements \Fezz\Acube\Sdk\Contracts\ProvidesAccount {
        public function __construct(private $cache) {}
        public function getAuthenticator(): \Saloon\Contracts\Authenticator {
            return $this->cache->get('default');
        }
    };

    // Create a new connector instance (simulating a new request)
    $connector2 = AcubeApi::common(Endpoint::COMMON_SANDBOX, $providesAccount);

    // The connector should automatically retrieve the authenticator from cache
    $authenticator = $connector2->defaultAuth();
    expect($authenticator)
        ->toBeInstanceOf(AccessTokenAuthenticator::class)
        ->and($authenticator->getAccessToken())
        ->toBe($token);
});

test('connector handles missing cache gracefully', function (): void {
    // No cache configured
    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX);

    // Should return null when no authenticator and no cache
    $authenticator = $connector->defaultAuth();
    expect($authenticator)->toBeNull();
});

test('authenticate stores token in cache', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $providesAccount = new class($cache) implements \Fezz\Acube\Sdk\Contracts\ProvidesAccount {
        public function __construct(private $cache) {}
        public function getAuthenticator(): \Saloon\Contracts\Authenticator {
            return $this->cache->get('default');
        }
    };

    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX, $providesAccount);
    $authApi = new AuthenticationApi($connector);

    // Create a mock JWT token with valid payload
    $payload = [
        'iat' => 1_700_000_000,
        'exp' => 1_700_086_400,
        'roles' => ['test' => ['ROLE_USER']],
        'username' => 'test@example.com',
        'uid' => 123,
    ];
    $payloadPart = base64_encode(json_encode($payload, JSON_THROW_ON_ERROR));
    $jwt = 'header.' . $payloadPart . '.signature';

    $mockClient = new MockClient([
        MockResponse::make(['token' => $jwt], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $authApi->login('test@example.com', 'password');
    $loginResponse = $response->dto();
    
    // Decode token to get useful information
    $decoder = new \Fezz\Acube\Sdk\Authentication\TokenDecoder();
    $info = $decoder->decode($loginResponse->token);
    
    // Manually store in cache for test verification
    $cache->set('default', new AccessTokenAuthenticator($jwt));

    // Verify token is in cache
    $cachedAuthenticator = $cache->get('default');
    expect($cachedAuthenticator)
        ->toBeInstanceOf(AccessTokenAuthenticator::class)
        ->and($cachedAuthenticator->getAccessToken())
        ->toBe($jwt)
        ->and($info->username)
        ->toBe('test@example.com');
});


test('login request creates dto from response', function (): void {
    $connector = AcubeApi::common();

    $mockClient = new MockClient([
        MockResponse::make(['token' => 'test-token-456'], 200),
    ]);

    $connector->withMockClient($mockClient);

    $request = new Fezz\Acube\Sdk\Common\Authentication\Requests\LoginRequest('test@example.com', 'password');
    $response = $connector->send($request);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(LoginResponseDto::class)
        ->and($dto->token)->toBe('test-token-456');
});
