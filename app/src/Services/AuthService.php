<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthContract;
use App\Dto\LoginDto;

/**
 * Authenticate service.
 */
class AuthService implements AuthContract
{
    /**
     * Log in.
     *
     * @param LoginDto $dto Log in DTO.
     * @return bool
     */
    public function login(LoginDto $dto): bool
    {
        if ($dto->getLogin() === 'admin' && $dto->getPassword() === '123') {
            $this->store($dto);

            return true;
        }

        return false;
    }

    /**
     * Log out.
     *
     * @return bool
     */
    public function logout(): bool
    {
        unset($_SESSION['user']);
        return session_destroy();
    }

    /**
     * Is current user logged in?
     *
     * @return bool
     */
    public function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Store user logged in status.
     *
     * @param LoginDto $dto Log in DTO
     * @return void
     */
    private function store(LoginDto $dto): void
    {
        $_SESSION['user'] = $dto->getLogin();
    }
}