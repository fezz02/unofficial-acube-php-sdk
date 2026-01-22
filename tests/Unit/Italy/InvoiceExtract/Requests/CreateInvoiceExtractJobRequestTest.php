<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\CreateInvoiceExtractJobRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests\CreateInvoiceExtractJobRequest;
use Saloon\Data\MultipartValue;

test('defaultBody reads file when file exists', function (): void {
    // Create a temporary file
    $tempFile = tmpfile();
    $tempPath = stream_get_meta_data($tempFile)['uri'];
    file_put_contents($tempPath, 'test pdf content');

    $dto = new CreateInvoiceExtractJobRequestDto(
        file_path: $tempPath
    );

    $request = new CreateInvoiceExtractJobRequest($dto);

    // Use reflection to access protected method
    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body[0])->toBeInstanceOf(MultipartValue::class)
        ->and($body[0]->value)->toBe('test pdf content');

    // Cleanup
    fclose($tempFile);
});
