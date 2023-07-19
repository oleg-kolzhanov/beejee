<?php declare(strict_types=1);

namespace App\Dto;

/**
 * Login DTO.
 */
class LoginDto
{
    /**
     * Constructor.
     *
     * @param string $login Login
     * @param string $password Password
     */
    public function __construct(
        private string $login,
        private string $password,
    )
    {
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Set login.
     *
     * @param string $login Login
     * @return $this
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password Password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}