<?php declare(strict_types=1);

namespace App\Dto;

/**
 * To Do list DTO.
 */
class TodoListDto
{
    /**
     * Constructor.
     *
     * @param int $draw Current page number
     * @param array $columns Columns
     * @param array $order Order
     * @param int $start Start row number
     * @param int $length Rows quantity
     * @param SearchDto $search Search
     */
    public function __construct(
        private int $draw,
        private array $columns,
        private array $order,
        private int $start,
        private int $length,
        private SearchDto $search,
    )
    {
    }

    /**
     * Get current page number.
     *
     * @return int
     */
    public function getDraw(): int
    {
        return $this->draw;
    }

    /**
     * Set current page number.
     *
     * @param int $draw Current page number
     * @return TodoListDto
     */
    public function setDraw(int $draw): self
    {
        $this->draw = $draw;
        return $this;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Set columns.
     *
     * @param array $columns Columns
     * @return TodoListDto
     */
    public function setColumns(array $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Get order.
     *
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * Get order.
     *
     * @param array $order Order
     * @return TodoListDto
     */
    public function setOrder(array $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get start row number.
     *
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * Set start row number.
     *
     * @param int $start Start row number
     * @return TodoListDto
     */
    public function setStart(int $start): self
    {
        $this->start = $start;
        return $this;
    }

    /**
     * Get rows quantity.
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Set rows quantity.
     *
     * @param int $length Rows quantity
     * @return TodoListDto
     */
    public function setLength(int $length): self
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Get search.
     *
     * @return SearchDto
     */
    public function getSearch(): SearchDto
    {
        return $this->search;
    }

    /**
     * Set search.
     *
     * @param SearchDto $search Search
     * @return TodoListDto
     */
    public function setSearch(SearchDto $search): self
    {
        $this->search = $search;
        return $this;
    }
}