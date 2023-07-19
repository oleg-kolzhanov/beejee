<?php declare(strict_types=1);

namespace App\Dto;

/**
 * Search DTO.
 */
class SearchDto
{
    /**
     * Constructor.
     *
     * @param string $value Value
     * @param bool $regex Is search regex
     */
    public function __construct(
        private string $value,
        private bool $regex,
    )
    {
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set value.
     *
     * @param string $value Value
     * @return SearchDto
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Is search regex?
     *
     * @return bool
     */
    public function isRegex(): bool
    {
        return $this->regex;
    }

    /**
     * Set search regex
     *
     * @param bool $regex Search regex
     * @return SearchDto
     */
    public function setRegex(bool $regex): self
    {
        $this->regex = $regex;
        return $this;
    }
}