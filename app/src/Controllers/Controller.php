<?php declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\Contracts\AuthContract;
use DI\DependencyException;
use DI\NotFoundException;
use Jenssegers\Blade\Blade;

/**
 * Base controller.
 */
class Controller
{
    /**
     * @var App Application instance.
     */
    protected App $app;

    /**
     * @var bool Is current user logged in?
     */
    protected bool $isLogged;

    /**
     * Constructor.
     *
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct()
    {
        $this->app = App::getInstance();
        /** @var AuthContract $authService */
        $authService = $this->app->getContainer()->make(AuthContract::class);
        $this->isLogged = $authService->isLogged();
    }

    /**
     * Render template.
     *
     * @param string $template Template name
     * @param array $data Data to parse to template.
     * @return string
     */
    protected function render(string $template, array $data = []): string
    {
        $blade = new Blade([APP_DIR . '/views'], APP_DIR . '/cache');
        return $blade->render($template, $this->getData($data));
    }

    /**
     * Make JSON resource.
     *
     * @param array $data
     * @return string
     */
    protected function resource(array $data = []): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($this->getData($data));
    }

    /**
     * Render message template.
     *
     * @param string $header Message header
     * @param string $text Message text
     * @param string $link Message button link
     * @param string $button Message button text
     * @return string
     */
    protected function message(
        string $header,
        string $text,
        string $link,
        string $button
    ): string
    {
        return $this->render('messages.info', [
            'messageHeader' => $header,
            'messageText' => $text,
            'messageLink' => $link,
            'messageButton' => $button,
        ]);
    }

    /**
     * Make not found response.
     *
     * @return string
     */
    protected function notFound(): string
    {
        header('Not found', true, 404);

        $messageHeader = 'Not found';
        $messageText = 'This page not found.';
        $messageLink = '/';
        $messageButton = 'Go home';

        return $this->message($messageHeader, $messageText, $messageLink, $messageButton);
    }

    /**
     * Make access denied response.
     *
     * @return string
     */
    protected function accessDenied(): string
    {
        header('Access denied', true, 403);

        $messageHeader = 'Access denied';
        $messageText = 'Log in to access.';
        $messageLink = '/login';
        $messageButton = 'Log in';

        return $this->message($messageHeader, $messageText, $messageLink, $messageButton);
    }

    /**
     * Add common data to template data.
     *
     * @param array $data Template data
     * @return array
     */
    private function getData(array $data): array
    {
        $dataCommon = [
            'isLogged' => $this->isLogged,
        ];

        return array_merge($data, $dataCommon);
    }
}