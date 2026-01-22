# Laravel Examples

Laravel examples – optional, provided as reference only.

## Token Cache Implementation

```php
<?php

declare(strict_types=1);

namespace App\Classes;

use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Contracts\TokenCache;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;
use Illuminate\Support\Facades\Cache;

final readonly class LaravelEncryptedTokenCache implements TokenCache
{
    private const int TOKEN_HOURS_TTL = 20;

    /**
     * @param  string  $key  A unique cache key identifying the authentication context. Since we support multiple account authentication, you can use a completely unique key to reference different accounts (e.g., based on account ID, endpoint, service, or any combination).
     * @return AccessTokenAuthenticator The cached authenticator instance
     *
     * @throws TokenNotFoundException If the authenticator is not present or expired
     */
    public function get(string $key): AccessTokenAuthenticator
    {
        $accessToken = Cache::tags(['acube'])->get($key, null);

        throw_if($accessToken === null, TokenNotFoundException::class);

        return new AccessTokenAuthenticator(decrypt($accessToken));
    }

    /**
     * @param  string  $key  A unique cache key identifying the authentication context. Since we support multiple account authentication, you can use a completely unique key to reference different accounts (e.g., based on account ID, endpoint, service, or any combination).
     * @param  AccessTokenAuthenticator  $authenticator  The authenticator to cache
     */
    public function set(string $key, AccessTokenAuthenticator $authenticator): void
    {
        Cache::tags(['acube'])->put($key, encrypt($authenticator->accessToken), now()->addHours(self::TOKEN_HOURS_TTL));
    }

    public function clear(): void
    {
        Cache::tags(['acube'])->flush();
    }

    /**
     * @param  string  $key  A unique cache key identifying the authentication context. Since we support multiple account authentication, you can use a completely unique key to reference different accounts (e.g., based on account ID, endpoint, service, or any combination).
     */
    public function forget(string $key): void
    {
        Cache::tags(['acube'])->forget($key);
    }
}
```

## ProvidesAccount Implementation (Sandbox)

```php
<?php

declare(strict_types=1);

namespace App\Classes;

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Common\CommonConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Contracts\ProvidesAccount;
use Fezz\Acube\Sdk\Contracts\TokenCache;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Contracts\Authenticator;

final readonly class AcubeSandboxRootAccountProvider implements ProvidesAccount
{
    private function __construct(private readonly TokenCache $cache, private readonly string $key) {}

    public static function configure(): self
    {
        $object = new self(
            cache: new LaravelEncryptedTokenCache,
            key: hash('sha256', 'sandbox-root-account'),
        );

        $object->authenticate();

        return $object;
    }

    public function getAuthenticator(): Authenticator
    {
        return $this->cache->get($this->key);
    }

    public function italy(): ItalyConnector
    {
        return AcubeApi::italy(
            endpoint: Endpoint::ITALY_SANDBOX,
            providesAccount: $this,
        );
    }

    public function common(): CommonConnector
    {
        return AcubeApi::common(
            endpoint: Endpoint::COMMON_SANDBOX,
            providesAccount: $this,
        );
    }

    private function authenticate(): void
    {
        if ($this->isAlreadyAuthenticated()) {
            return;
        }

        $loginResponseDto = AcubeApi::common()
            ->authentication()
            ->login(config('acube.email'), config('acube.password'))
            ->dto();

        $this->cache->set($this->key, new AccessTokenAuthenticator($loginResponseDto->token));
    }

    private function isAlreadyAuthenticated(): bool
    {
        try {
            $this->getAuthenticator();

            return true;
        } catch (TokenNotFoundException) {
            return false;
        }
    }
}
```

## ProvidesAccount Implementation (Configurable Endpoint)

```php
<?php

declare(strict_types=1);

namespace App\Classes;

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Common\CommonConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Contracts\ProvidesAccount;
use Fezz\Acube\Sdk\Contracts\TokenCache;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Contracts\Authenticator;

final readonly class AcubeAccountProvider implements ProvidesAccount
{
    public function __construct(
        private readonly TokenCache $cache,
        private readonly string $key,
        private readonly Endpoint $commonEndpoint = Endpoint::COMMON_SANDBOX,
        private readonly Endpoint $italyEndpoint = Endpoint::ITALY_SANDBOX,
    ) {
        $this->authenticate();
    }

    public function getAuthenticator(): Authenticator
    {
        return $this->cache->get($this->key);
    }

    public function italy(): ItalyConnector
    {
        return AcubeApi::italy(
            endpoint: $this->italyEndpoint,
            providesAccount: $this,
        );
    }

    public function common(): CommonConnector
    {
        return AcubeApi::common(
            endpoint: $this->commonEndpoint,
            providesAccount: $this,
        );
    }

    private function authenticate(): void
    {
        if ($this->isAlreadyAuthenticated()) {
            return;
        }

        $loginResponseDto = AcubeApi::common($this->commonEndpoint)
            ->authentication()
            ->login(config('acube.email'), config('acube.password'))
            ->dto();

        $this->cache->set($this->key, new AccessTokenAuthenticator($loginResponseDto->token));
    }

    private function isAlreadyAuthenticated(): bool
    {
        try {
            $this->getAuthenticator();

            return true;
        } catch (TokenNotFoundException) {
            return false;
        }
    }
}
```

## Usage Example

```php
use App\Classes\AcubeSandboxRootAccountProvider;

$response = AcubeSandboxRootAccountProvider::configure()
    ->italy()
    ->invoices()
    ->list();
```
