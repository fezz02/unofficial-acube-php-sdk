<?php

use Fezz\Acube\Sdk\AcubeApi;
use Saloon\Contracts\Authenticator;
use Fezz\Acube\Sdk\Contracts\TokenCache;
use Fezz\Acube\Sdk\Contracts\ProvidesAccount;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Authentication\UnsafeInMemoryTokenCache;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;

final readonly class _UnSafeAccountProvider implements ProvidesAccount
{
    private function __construct(private readonly TokenCache $cache, private readonly string $key) {}

    public static function configure(): self
    {
        return new self(
            cache: new _UnsafeInMemoryTokenCache(),
            key: hash('sha256', 'john-doe-account')
        );
    }

    public function authenticate(string $email, string $password)
    {
        /** @var LoginResponseDto $loginResponseDto */
        $loginResponseDto = AcubeApi::common()
            ->authentication()
            ->login($email, $password)
            ->dto();

        $this->cache->set($this->key, new AccessTokenAuthenticator($loginResponseDto->token));
    }

    public function getAuthenticator(): Authenticator
    {
        return $this->cache->get($this->key);
    }
}
