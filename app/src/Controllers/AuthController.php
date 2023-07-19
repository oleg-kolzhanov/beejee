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
    /**
     * @var AuthContract Authenticate service.
     */
    private AuthContract $authService;

    /**
     * @var LoginTransformer Log in transformer.
     */
    private LoginTransformer $loginTransformer;

    /**
     * Constructor.
     *
     * @param AuthContract $authService Authenticate service
     * @param LoginTransformer $loginTransformer Log in transformer
     */
    public function __construct(AuthContract $authService, LoginTransformer $loginTransformer)
    {
        $this->authService = $authService;
        $this->loginTransformer = $loginTransformer;

        parent::__construct();
    }

    /**
     * Show log in form.
     *
     * @return string
     */
    public function index(): string
    {
        return $this->render('auth.login');
    }

    /**
     * Log in user.
     *
     * @return string
     * @throws Throwable
     */
    public function login(): string
    {
        $dto = $this->loginTransformer->transform($_POST);

        if ($this->authService->login($dto)) {
            $messageHeader = 'Welcome';
            $messageText = 'You are logged in!';
            $messageLink = '/';
        } else {
            $messageHeader = 'Auth error';
            $messageText = 'Check login and password and try again.';
            $messageLink = '/login';
        }
        $messageButton = 'Ok';

        return $this->message($messageHeader, $messageText, $messageLink, $messageButton);
    }

    /**
     * Log out current user.
     *
     * @return string
     */
    public function logout(): string
    {
        if ($this->authService->logout()) {
            $messageHeader = 'Bye!';
            $messageText = 'You are logged out.';
            $messageButton = 'Ok';
        } else {
            $messageHeader = 'Logout error';
            $messageText = 'Try again later.';
            $messageButton = 'Try again';
        }
        $messageLink = '/';

        return $this->message($messageHeader, $messageText, $messageLink, $messageButton);
    }
}