<?php declare(strict_types=1);

namespace App\Dto;

/**
 * To Do create DTO.
 */
class TodoCreateDto
{
    /**
     * Constructor.
     *
     * @param string $name Name
     * @param string $email Email
     * @param string $text Text
     */
    public function __construct(
        private string $name,
        private string $email,
        private string $text,
    )
    {
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name Name
     * @return TodoCreateDto
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email Email
     * @return TodoCreateDto
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text.
     *
     * @param string $text Text
     * @return TodoCreateDto
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }
}