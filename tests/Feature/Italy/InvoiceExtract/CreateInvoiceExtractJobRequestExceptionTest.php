<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\CreateInvoiceExtractJobRequestDto;

test('throws exception when file read fails', function (): void {
    // Set up custom error handler to suppress file_get_contents warnings
    $oldErrorHandler = set_error_handler(function ($errno, $errstr, $errfile, $errline): bool {
        // Suppress warnings from file_get_contents in this test
        if (str_contains($errstr, 'file_get_contents')) {
            return true; // Suppress the error
        }

        return false; // Let other errors through
    }, E_WARNING);

    try {
        // Create a file and make it unreadable
        $tempPath = sys_get_temp_dir() . '/test_file_' . uniqid() . '.pdf';
        file_put_contents($tempPath, 'test');

        // Remove all permissions
        chmod($tempPath, 0000);

        // Verify file_exists returns true but file_get_contents returns false
        if (! file_exists($tempPath)) {
            chmod($tempPath, 0644);
            unlink($tempPath);
            return;
        }

        $testRead = @file_get_contents($tempPath);
        if ($testRead !== false) {
            chmod($tempPath, 0644);
            unlink($tempPath);
            return;
        }

        $connector = AcubeApi::italy();
        $api = $connector->invoiceExtract();

        $dto = new CreateInvoiceExtractJobRequestDto(
            file_path: $tempPath
        );

        // This should throw RuntimeException when the request tries to read the file (line 92)
        // The exception is thrown in defaultBody() which is called when the request is sent
        expect(fn() => $api->createJob($dto))
            ->toThrow(RuntimeException::class, 'Failed to read file');

        // Cleanup
        chmod($tempPath, 0644);
        unlink($tempPath);
    } finally {
        restore_error_handler();
    }
});
