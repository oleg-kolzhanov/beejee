<?php declare(strict_types=1);

namespace App\Dto;

/**
 * Order DTO.
 */
class OrderDto
{
    /**
     * Constructor.
     *
     * @param int $column Column
     * @param string $dir Direction
     */
    public function __construct(
        private int $column,
        private string $dir,
    )
    {
    }

    /**
     * Get column.
     *
     * @return int
     */
    public function getColumn(): int
    {
        return $this->column;
    }

    /**
     * Set column.
     *
     * @param int $column Column
     * @return OrderDto
     */
    public function setColumn(int $column): self
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Get direction.
     *
     * @return string
     */
    public function getDir(): string
    {
        return $this->dir;
    }

    /**
     * Set direction.
     *
     * @param string $dir Direction
     * @return OrderDto
     */
    public function setDir(string $dir): self
    {
        $this->dir = $dir;
        return $this;
    }
}