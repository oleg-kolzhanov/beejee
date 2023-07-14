<?php

namespace App\Contracts;

use App\Dto\LoginDto;

interface AuthContract
{
    public function login(LoginDto $dto): bool;

    public function isLogged(): bool;

    public function logout(): bool;
}