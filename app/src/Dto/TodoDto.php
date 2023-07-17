<?php declare(strict_types=1);

namespace App\Dto;

/**
 * ToDo DTO.
 */
class TodoDto
{
    /**
     * Constructor.
     *
     */
    public function __construct(
        private string $name,
        private string $email,
        private string $text,
    )
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return TodoDto
     */
    public function setName(string $name): TodoDto
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return TodoDto
     */
    public function setEmail(string $email): TodoDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return TodoDto
     */
    public function setText(string $text): TodoDto
    {
        $this->text = $text;
        return $this;
    }
}