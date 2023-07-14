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
     */
    public function __construct(
        private string $login,
        private string $password,
    )
    {
    }

    /**
     * .
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     *
     *
     * @param string $login .
     * @return $this
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     *
     *
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}