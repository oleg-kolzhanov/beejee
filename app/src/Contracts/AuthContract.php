<?php

namespace App\Contracts;

use App\Dto\LoginDto;

/**
 * Authenticate interface.
 */
interface AuthContract
{
    /**
     * Log in user.
     *
     * @param LoginDto $dto
     * @return bool
     */
    public function login(LoginDto $dto): bool;

    /**
     * Check if user is logged in.
     *
     * @return bool
     */
    public function isLogged(): bool;

    /**
     * Logout user.
     *
     * @return bool
     */
    public function logout(): bool;
}