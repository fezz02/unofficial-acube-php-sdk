<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Requests\SendInvoiceRequest;

test('defaultBody returns array when invoice is array', function (): void {
    $invoice = ['fattura_elettronica_header' => [], 'fattura_elettronica_body' => []];
    $request = new SendInvoiceRequest($invoice);

    // Use reflection to access protected method
    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBe($invoice);
});
