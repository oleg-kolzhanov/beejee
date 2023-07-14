<?php declare(strict_types=1);

use App\Contracts\AuthContract;
use App\Services\AuthService;
use function DI\create;

return [
    // Bind an interface to an implementation
    AuthContract::class => create(AuthService::class),
//
//    // Configure Twig
//    Environment::class => function () {
//        $loader = new FilesystemLoader(__DIR__ . '/../src/SuperBlog/Views');
//        return new Environment($loader);
//    },
];