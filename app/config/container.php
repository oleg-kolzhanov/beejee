<?php declare(strict_types=1);

use App\Contracts\AuthContract;
use App\Services\AuthService;
use function DI\create;

/**
 * DI container config.
 */
return [
    AuthContract::class => create(AuthService::class),
];