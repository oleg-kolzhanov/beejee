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

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct()
    {
        $this->app = App::getInstance();

        /** @var AuthContract $authService */
        $authService = $this->app->getContainer()->make(AuthContract::class);
        $this->data = [
            'isLogged' => $authService->isLogged(),
        ];
    }

    protected function render(string $template, array $data = []): string
    {
        $blade = new Blade([APP_DIR . '/views'], APP_DIR . '/cache');
        return $blade->render($template, $this->getData($data));
    }

    protected function resource(array $data = []): string
    {
        return json_encode($this->getData($data));
    }

    /**
     * @param array $data
     * @return array
     */
    private function getData(array $data): array
    {
        return array_merge($data, $this->data);
    }
}