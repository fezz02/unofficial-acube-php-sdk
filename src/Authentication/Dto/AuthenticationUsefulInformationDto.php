<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Authentication\Dto;

/**
 * DTO representing relevant JWT payload information returned by A-Cube.
 *
 * This object exposes useful fields decoded from the JWT token issued
 * by A-Cube's /login endpoint. *
 *
 * @see https://docs.acubeapi.com/documentation/common/authentication/
 *
 * @param  int  $iat  Unix timestamp when the token was issued. ("Issued At")
 * @param  int  $exp  Unix timestamp when the token will expire. ("Expiration Time")
 * @param  array<string, list<string>>  $roles  Map of project domains to granted roles.
 * @param  string  $username  Email or username associated with the token.
 * @param  int  $uid  Unique user identifier provided by A-Cube.
 */
final readonly class AuthenticationUsefulInformationDto
{
    public function __construct(
        public int $iat,
        public int $exp,
        /** @var array<string, list<string>> */
        public array $roles,
        public string $username,
        public int $uid,
    ) {}
}
