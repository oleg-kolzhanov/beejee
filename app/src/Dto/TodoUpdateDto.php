<?php declare(strict_types=1);

namespace App\Dto;

/**
 * ToDo DTO.
 */
class TodoUpdateDto
{
    /**
     * Constructor.
     *
     */
    public function __construct(
        private string $text,
        private bool $done
    )
    {
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
     * @return TodoUpdateDto
     */

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }
    /**
     * @return boolean
     */
    public function isDone(): bool
    {
        return $this->done;
    }

    /**
     * @param boolean $done
     * @return TodoUpdateDto
     */
    public function setDone(bool $done): self
    {
        $this->done = $done;
        return $this;
    }

}