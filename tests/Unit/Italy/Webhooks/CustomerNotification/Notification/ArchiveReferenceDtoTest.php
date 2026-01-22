<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\ArchiveReferenceDto;

test('can create archive reference data from array', function (): void {
    $data = [
        'identificativo_sdi' => '100',
        'nome_file' => 'IT01234567890_11111.zip',
    ];

    $dto = ArchiveReferenceDto::from($data);

    expect($dto)
        ->toBeInstanceOf(ArchiveReferenceDto::class)
        ->and($dto->identificativo_sdi)->toBe('100')
        ->and($dto->nome_file)->toBe('IT01234567890_11111.zip');
});
