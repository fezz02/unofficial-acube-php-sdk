<?php

declare(strict_types=1);

arch()
    ->expect('Fezz\Acube\Sdk')
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump'])
    ->group('architecture');

arch()
    ->expect('Fezz\Acube\Sdk\Traits')
    ->toBeTraits()
    ->group('architecture');

arch()
    ->expect('Fezz\Acube\Sdk\Contracts')
    ->toBeInterfaces()
    ->group('architecture');
