<?php declare(strict_types=1);

namespace App\Dto;

/**
 * To Do update DTO.
 */
class TodoUpdateDto
{
    /**
     * Constructor.
     *
     * @param string $text Text
     * @param bool $done Done
     */
    public function __construct(
        private string $text,
        private bool $done
    )
    {
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
     * @return TodoUpdateDto
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Is To Do done?
     *
     * @return boolean
     */
    public function isDone(): bool
    {
        return $this->done;
    }

    /**
     * Set To Do done.
     *
     * @param boolean $done Done
     * @return TodoUpdateDto
     */
    public function setDone(bool $done): self
    {
        $this->done = $done;
        return $this;
    }
}