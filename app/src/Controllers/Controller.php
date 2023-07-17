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
    private App $app;

    private array $data;

    public function __construct()
    {
        $this->app = App::getInstance();
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function render(string $template, array $data = []): string
    {
        $blade = new Blade([APP_DIR . '/views'], APP_DIR . '/cache');
        return $blade->render($template, $this->getData($data));
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function resource(array $data = []): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($this->getData($data));
    }

    /**
     * @param array $data
     * @return array
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function getData(array $data): array
    {
        /** @var AuthContract $authService */
        $authService = $this->app->getContainer()->make(AuthContract::class);
        $this->data = [
            'isLogged' => $authService->isLogged(),
        ];

        return array_merge($data, $this->data);
    }
}