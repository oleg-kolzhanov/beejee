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
     */
    public function __construct(
        private int $column,
        private string $dir,
    )
    {
    }

    /**
     * @return int
     */
    public function getColumn(): int
    {
        return $this->column;
    }

    /**
     * @param int $column
     * @return OrderDto
     */
    public function setColumn(int $column): OrderDto
    {
        $this->column = $column;
        return $this;
    }

    /**
     * @return string
     */
    public function getDir(): string
    {
        return $this->dir;
    }

    /**
     * @param string $dir
     * @return OrderDto
     */
    public function setDir(string $dir): OrderDto
    {
        $this->dir = $dir;
        return $this;
    }
}