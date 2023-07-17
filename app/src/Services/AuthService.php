<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthContract;
use App\Dto\LoginDto;

class AuthService implements AuthContract
{
    public function login(LoginDto $dto): bool
    {
        if ($dto->getLogin() === 'admin' && $dto->getPassword() === '123') {
            $this->store($dto);

            return true;
        }

        return false;
    }

    public function logout(): bool
    {
        unset($_SESSION['user']);
        return session_destroy();
    }

    public function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    private function store(LoginDto $dto): void
    {
        $_SESSION['user'] = $dto->getLogin();
    }
}