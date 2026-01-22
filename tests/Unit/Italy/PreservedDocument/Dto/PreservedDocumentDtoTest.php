<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\PreservedDocumentDto;

test('preserved document dto can be created from array', function (): void {
    $data = [
        'id' => 'preserved-123',
        'document_type' => 'invoice',
        'created_at' => '2024-01-01T00:00:00Z',
    ];

    $dto = PreservedDocumentDto::from($data);

    expect($dto)
        ->toBeInstanceOf(PreservedDocumentDto::class)
        ->and($dto->data)->toBe($data);
});
