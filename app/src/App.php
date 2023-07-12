<?php declare(strict_types=1);

namespace App;

/**
 * Приложение.
 */
class App
{
    /**
     * Метод по умолчанию.
     *
     * @return void
     */
    public function __invoke(): void
    {
        print 'Hi!';
    }
}