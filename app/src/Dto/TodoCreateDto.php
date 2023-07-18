<?php declare(strict_types=1);

namespace App\Dto;

/**
 * ToDo DTO.
 */
class TodoCreateDto
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
     * @return TodoCreateDto
     */
    public function setName(string $name): TodoCreateDto
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
     * @return TodoCreateDto
     */
    public function setEmail(string $email): TodoCreateDto
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
     * @return TodoCreateDto
     */
    public function setText(string $text): TodoCreateDto
    {
        $this->text = $text;
        return $this;
    }
}