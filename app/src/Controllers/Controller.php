<?php declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\Contracts\AuthContract;
use DI\DependencyException;
use DI\NotFoundException;
use Jenssegers\Blade\Blade;

/**
 * Controller.
 */
class Controller
{
    protected App $app;
    protected bool $isLogged;

    public function __construct()
    {
        $this->app = App::getInstance();
        /** @var AuthContract $authService */
        $authService = $this->app->getContainer()->make(AuthContract::class);
        $this->isLogged = $authService->isLogged();
    }

    protected function render(string $template, array $data = []): string
    {
        $blade = new Blade([APP_DIR . '/views'], APP_DIR . '/cache');
        return $blade->render($template, $this->getData($data));
    }

    protected function resource(array $data = []): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($this->getData($data));
    }

    /**
     * @param array $data
     * @return array
     */
    private function getData(array $data): array
    {
        $dataCommon = [
            'isLogged' => $this->isLogged,
        ];

        return array_merge($data, $dataCommon);
    }

    protected function notFound(): string
    {
        header('Not found', true, 404);

        $messageHeader = 'Not found';
        $messageText = 'This page not found.';
        $messageLink = '/';
        $messageButton = 'Go home';

        return $this->render('messages.info', [
            'messageHeader' => $messageHeader,
            'messageText' => $messageText,
            'messageLink' => $messageLink,
            'messageButton' => $messageButton,
        ]);
    }

    protected function accessDenied(): string
    {
        header('Access denied', true, 403);

        $messageHeader = 'Access denied';
        $messageText = 'Log in to access.';
        $messageLink = '/login';
        $messageButton = 'Log in';

        return $this->render('messages.info', [
            'messageHeader' => $messageHeader,
            'messageText' => $messageText,
            'messageLink' => $messageLink,
            'messageButton' => $messageButton,
        ]);
    }
}