<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

/**
 * Data Transfer Object for the get user sub-accounts response.
 *
 * Represents the response from the GET /users/me/accounts endpoint,
 * which returns an array of user sub-account objects.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/#get-user-sub-accounts
 */
final readonly class GetUserSubAccountsResponseDto
{
    /**
     * Create a new get user sub-accounts response DTO.
     *
     * @param  array<UserSubAccountDto>  $accounts  The array of user sub-account DTOs
     */
    public function __construct(
        public array $accounts
    ) {}

    /**
     * Create a DTO instance from an API response array.
     *
     * The API returns an array of user objects directly. This method
     * maps each user object to a UserSubAccountDto instance.
     *
     * @param  array<int, array<string, mixed>>|array<string, mixed>  $data  The API response data
     * @return self A new instance of the response DTO
     */
    public static function from(array $data): self
    {
        // Handle empty array
        if ($data === []) {
            return new self([]);
        }

        // Ensure each item is an array before mapping
        $accounts = [];
        foreach ($data as $item) {
            if (! empty($item) && is_array($item)) {
                /** @var array<string, mixed> $item */
                $accounts[] = UserSubAccountDto::from($item);
            }
        }

        return new self($accounts);
    }
}
