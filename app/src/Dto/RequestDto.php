<?php declare(strict_types=1);

namespace App\Dto;

/**
 * Login DTO.
 */
class RequestDto
{
    /**
     * Constructor.
     *
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
     * @return int
     */
    public function getDraw(): int
    {
        return $this->draw;
    }

    /**
     * @param int $draw
     * @return RequestDto
     */
    public function setDraw(int $draw): RequestDto
    {
        $this->draw = $draw;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     * @return RequestDto
     */
    public function setColumns(array $columns): RequestDto
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * @param array $order
     * @return RequestDto
     */
    public function setOrder(array $order): array
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @param int $start
     * @return RequestDto
     */
    public function setStart(int $start): RequestDto
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return RequestDto
     */
    public function setLength(int $length): RequestDto
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return SearchDto
     */
    public function getSearch(): SearchDto
    {
        return $this->search;
    }

    /**
     * @param SearchDto $search
     * @return RequestDto
     */
    public function setSearch(SearchDto $search): RequestDto
    {
        $this->search = $search;
        return $this;
    }
}