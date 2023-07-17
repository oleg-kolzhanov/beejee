<?php declare(strict_types=1);

namespace App\Dto;

/**
 * Column DTO.
 */
class ColumnDto
{
    /**
     * Constructor.
     *
     */
    public function __construct(
        private string $data,
        private string $name,
        private bool $searchable,
        private bool $orderable,
        private SearchDto $search,
    )
    {
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return ColumnDto
     */
    public function setData(string $data): ColumnDto
    {
        $this->data = $data;
        return $this;
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
     * @return ColumnDto
     */
    public function setName(string $name): ColumnDto
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * @param bool $searchable
     * @return ColumnDto
     */
    public function setSearchable(bool $searchable): ColumnDto
    {
        $this->searchable = $searchable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOrderable(): bool
    {
        return $this->orderable;
    }

    /**
     * @param bool $orderable
     * @return ColumnDto
     */
    public function setOrderable(bool $orderable): ColumnDto
    {
        $this->orderable = $orderable;
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
     * @return ColumnDto
     */
    public function setSearch(SearchDto $search): ColumnDto
    {
        $this->search = $search;
        return $this;
    }
}