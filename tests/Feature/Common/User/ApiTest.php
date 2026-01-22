<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Common\User\Dto\CreateUserSubAccountRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\GetUserSubAccountsResponseDto;
use Fezz\Acube\Sdk\Common\User\Dto\UserSubAccountDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('can get user sub accounts', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $mockData = [
        [
            'email' => 'user1@example.com',
            'fiscal_id' => 'ABC123',
            'fullname' => 'User One',
            'enabled' => true,
            'created_at' => '2024-01-01T00:00:00Z',
            'updated_at' => '2024-01-01T00:00:00Z',
        ],
        [
            'email' => 'user2@example.com',
            'fiscal_id' => 'DEF456',
            'fullname' => null,
            'enabled' => false,
            'created_at' => '2024-01-02T00:00:00Z',
            'updated_at' => '2024-01-02T00:00:00Z',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->subAccounts();
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(GetUserSubAccountsResponseDto::class)
        ->and($dto->accounts)->toHaveCount(2)
        ->and($dto->accounts[0])->toBeInstanceOf(UserSubAccountDto::class)
        ->and($dto->accounts[0]->email)->toBe('user1@example.com')
        ->and($dto->accounts[0]->fiscal_id)->toBe('ABC123')
        ->and($dto->accounts[0]->fullname)->toBe('User One')
        ->and($dto->accounts[0]->enabled)->toBeTrue()
        ->and($dto->accounts[1]->fullname)->toBeNull()
        ->and($dto->accounts[1]->enabled)->toBeFalse();
});

test('can get empty user sub accounts', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $mockClient = new MockClient([
        MockResponse::make([], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->subAccounts();
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(GetUserSubAccountsResponseDto::class)
        ->and($dto->accounts)->toHaveCount(0);
});

test('can create user sub account', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $requestDto = new CreateUserSubAccountRequestDto(
        email: 'newuser@example.com',
        password: 'Password123!',
        fiscal_id: 'XYZ789',
        fullname: 'New User',
        enabled: true
    );

    $mockData = [
        'email' => 'newuser@example.com',
        'fiscal_id' => 'XYZ789',
        'fullname' => 'New User',
        'enabled' => true,
        'created_at' => '2024-01-03T00:00:00Z',
        'updated_at' => '2024-01-03T00:00:00Z',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->createSubAccount($requestDto);

    expect($response->status())->toBe(201);
});

test('user sub account dto can be created from array', function (): void {
    $data = [
        'email' => 'test@example.com',
        'fiscal_id' => 'TEST123',
        'fullname' => 'Test User',
        'enabled' => true,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z',
    ];

    $dto = UserSubAccountDto::from($data);

    expect($dto)
        ->toBeInstanceOf(UserSubAccountDto::class)
        ->and($dto->email)->toBe('test@example.com')
        ->and($dto->fiscal_id)->toBe('TEST123')
        ->and($dto->fullname)->toBe('Test User')
        ->and($dto->enabled)->toBeTrue();
});

test('user sub account dto handles null fullname', function (): void {
    $data = [
        'email' => 'test@example.com',
        'fiscal_id' => 'TEST123',
        'fullname' => null,
        'enabled' => false,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z',
    ];

    $dto = UserSubAccountDto::from($data);

    expect($dto->fullname)->toBeNull()
        ->and($dto->enabled)->toBeFalse();
});

test('create user sub account request creates dto from response', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $requestDto = new CreateUserSubAccountRequestDto(
        email: 'newuser@example.com',
        password: 'Password123!',
        fiscal_id: 'XYZ789',
        fullname: 'New User',
        enabled: true
    );

    $mockData = [
        [
            'email' => 'newuser@example.com',
            'fiscal_id' => 'XYZ789',
            'fullname' => 'New User',
            'enabled' => true,
            'created_at' => '2024-01-03T00:00:00Z',
            'updated_at' => '2024-01-03T00:00:00Z',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->createSubAccount($requestDto);
    $dto = $response->dto();

    expect($dto)->toBeInstanceOf(GetUserSubAccountsResponseDto::class);
});

test('create user sub account response dto can be created', function (): void {
    $dto = Fezz\Acube\Sdk\Common\User\Dto\CreateUserSubAccountResponseDto::from(['token' => 'test-token']);

    expect($dto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\User\Dto\CreateUserSubAccountResponseDto::class)
        ->and($dto->token)->toBe('test-token');
});

test('can get user sub account by id', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $mockData = [
        'email' => 'single@example.com',
        'fiscal_id' => 'SINGLE123',
        'fullname' => 'Single User',
        'enabled' => true,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:00:00Z',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->getSubAccount('account-123');
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(UserSubAccountDto::class)
        ->and($dto->email)->toBe('single@example.com')
        ->and($dto->fiscal_id)->toBe('SINGLE123');
});

test('can update user sub account', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $requestDto = new Fezz\Acube\Sdk\Common\User\Dto\UpdateUserSubAccountRequestDto(
        fullname: 'Updated Name',
        enabled: false
    );

    $mockData = [
        'email' => 'updated@example.com',
        'fiscal_id' => 'UPD123',
        'fullname' => 'Updated Name',
        'enabled' => false,
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-02T00:00:00Z',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->updateSubAccount('account-123', $requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(UserSubAccountDto::class)
        ->and($dto->fullname)->toBe('Updated Name')
        ->and($dto->enabled)->toBeFalse();
});

test('can delete user sub account', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $mockClient = new MockClient([
        MockResponse::make([], 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->deleteSubAccount('account-123');

    expect($response->status())->toBe(204);
});

test('can update sub account password', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $requestDto = new Fezz\Acube\Sdk\Common\User\Dto\UpdateSubAccountPasswordRequestDto(
        id: 'account-123',
        password: 'NewPassword123!'
    );

    $mockData = [
        'email' => 'user@example.com',
        'fullname' => 'User Name',
        'invoicing_vat_number' => 'VAT123',
        'invoicing_fiscal_id' => 'FISCAL123',
        'invoicing_address' => '123 Main St',
        'invoicing_city' => 'City',
        'invoicing_province' => 'Province',
        'invoicing_cap' => '12345',
        'invoicing_name' => 'Invoice Name',
        'invoicing_country' => 'IT',
        'invoicing_sdi_recipient_code' => 'SDI123',
        'invoicing_sdi_pec' => 'pec@example.com',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->updateSubAccountPassword($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto::class)
        ->and($dto->email)->toBe('user@example.com');
});

test('can get user profile', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $mockData = [
        'email' => 'profile@example.com',
        'fullname' => 'Profile User',
        'invoicing_vat_number' => 'VAT456',
        'invoicing_fiscal_id' => 'FISCAL456',
        'invoicing_address' => '456 Main St',
        'invoicing_city' => 'City2',
        'invoicing_province' => 'Province2',
        'invoicing_cap' => '67890',
        'invoicing_name' => 'Invoice Name2',
        'invoicing_country' => 'IT',
        'invoicing_sdi_recipient_code' => 'SDI456',
        'invoicing_sdi_pec' => 'pec2@example.com',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->getProfile('me');
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto::class)
        ->and($dto->email)->toBe('profile@example.com')
        ->and($dto->invoicing_vat_number)->toBe('VAT456');
});

test('can update user profile', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $requestDto = new Fezz\Acube\Sdk\Common\User\Dto\UpdateUserProfileRequestDto(
        fullname: 'Updated Profile',
        invoicing_vat_number: 'VAT789',
        invoicing_fiscal_id: null,
        invoicing_address: null,
        invoicing_city: null,
        invoicing_province: null,
        invoicing_cap: null,
        invoicing_name: null,
        invoicing_country: null,
        invoicing_sdi_recipient_code: null,
        invoicing_sdi_pec: null
    );

    $mockData = [
        'email' => 'updated@example.com',
        'fullname' => 'Updated Profile',
        'invoicing_vat_number' => 'VAT789',
        'invoicing_fiscal_id' => 'FISCAL789',
        'invoicing_address' => '789 Main St',
        'invoicing_city' => 'City3',
        'invoicing_province' => 'Province3',
        'invoicing_cap' => '11111',
        'invoicing_name' => 'Invoice Name3',
        'invoicing_country' => 'IT',
        'invoicing_sdi_recipient_code' => 'SDI789',
        'invoicing_sdi_pec' => 'pec3@example.com',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->updateProfile('me', $requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto::class)
        ->and($dto->fullname)->toBe('Updated Profile');
});

test('can update user password', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    $requestDto = new Fezz\Acube\Sdk\Common\User\Dto\UpdateUserPasswordRequestDto(
        id: 'me',
        password: 'NewUserPassword123!'
    );

    $mockData = [
        'email' => 'user@example.com',
        'fullname' => 'User Name',
        'invoicing_vat_number' => 'VAT999',
        'invoicing_fiscal_id' => 'FISCAL999',
        'invoicing_address' => '999 Main St',
        'invoicing_city' => 'City4',
        'invoicing_province' => 'Province4',
        'invoicing_cap' => '99999',
        'invoicing_name' => 'Invoice Name4',
        'invoicing_country' => 'IT',
        'invoicing_sdi_recipient_code' => 'SDI999',
        'invoicing_sdi_pec' => 'pec4@example.com',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $userApi->updatePassword($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto::class)
        ->and($dto->email)->toBe('user@example.com');
});

test('user profile dto can be created from array', function (): void {
    $data = [
        'email' => 'test@example.com',
        'fullname' => 'Test User',
        'invoicing_vat_number' => 'VAT123',
        'invoicing_fiscal_id' => 'FISCAL123',
        'invoicing_address' => '123 Main St',
        'invoicing_city' => 'City',
        'invoicing_province' => 'Province',
        'invoicing_cap' => '12345',
        'invoicing_name' => 'Invoice Name',
        'invoicing_country' => 'IT',
        'invoicing_sdi_recipient_code' => 'SDI123',
        'invoicing_sdi_pec' => 'pec@example.com',
    ];

    $dto = Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto::from($data);

    expect($dto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto::class)
        ->and($dto->email)->toBe('test@example.com')
        ->and($dto->invoicing_vat_number)->toBe('VAT123');
});
