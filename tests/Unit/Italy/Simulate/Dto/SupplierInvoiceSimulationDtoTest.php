<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Simulate\Dto\SupplierInvoiceSimulationDto;

test('supplier invoice simulation dto can be created from json', function (): void {
    $payload = ['foo' => 'bar'];

    $dto = SupplierInvoiceSimulationDto::fromJson($payload);

    expect($dto->contentType())->toBe('application/json')
        ->and($dto->toJson())->toBe($payload);
});

test('supplier invoice simulation dto can be created from xml', function (): void {
    $xml = '<Invoice>test</Invoice>';

    $dto = SupplierInvoiceSimulationDto::fromXml($xml);

    expect($dto->contentType())->toBe('application/xml')
        ->and($dto->toXml())->toBe($xml);
});

test('supplier invoice simulation dto throws when converting xml to json', function (): void {
    $dto = SupplierInvoiceSimulationDto::fromXml('<Invoice/>');

    $dto->toJson();
})->throws(InvalidArgumentException::class);

test('supplier invoice simulation dto throws when converting json to xml', function (): void {
    $dto = SupplierInvoiceSimulationDto::fromJson(['foo' => 'bar']);

    $dto->toXml();
})->throws(InvalidArgumentException::class);


