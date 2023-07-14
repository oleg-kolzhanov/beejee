<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\AuthContract;
use App\Dto\LoginTransformer;
use Throwable;

/**
 * Controller.
 */
class AuthController extends Controller
{
    private AuthContract $authService;
    private LoginTransformer $loginTransformer;

    public function __construct(AuthContract $authService, LoginTransformer $loginTransformer)
    {
        $this->authService = $authService;
        $this->loginTransformer = $loginTransformer;

        parent::__construct();
    }

    public function index(): string
    {
        return $this->render('auth.login');
    }

    /**
     * @throws Throwable
     */
    public function login(): string
    {
        $dto = $this->loginTransformer->transform($_POST);
        $template = 'auth.login-' . (($this->authService->login($dto)) ? 'success' : 'error');

        return $this->render($template);
    }

    /**
     * @throws Throwable
     */
    public function logout(): string
    {
        $template = 'auth.logout-' . (($this->authService->logout()) ? 'success' : 'error');

        return $this->render($template);
    }
}