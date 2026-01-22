<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Api;

test('italy connector exposes business registry api', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    expect($api)->toBeInstanceOf(Api::class);
});
