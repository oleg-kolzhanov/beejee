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
     */
    public function __construct(
        private string $value,
        private bool $regex,
    )
    {
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return SearchDto
     */
    public function setValue(string $value): SearchDto
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRegex(): bool
    {
        return $this->regex;
    }

    /**
     * @param bool $regex
     * @return SearchDto
     */
    public function setRegex(bool $regex): SearchDto
    {
        $this->regex = $regex;
        return $this;
    }
}