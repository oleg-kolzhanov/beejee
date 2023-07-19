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
     * @param string $data Column data
     * @param string $name Column name
     * @param bool $searchable Is column searchable
     * @param bool $orderable Is column orderable
     * @param SearchDto $search Column searh
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
     * Get column data.
     *
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Set column data.
     *
     * @param string $data Column data
     * @return ColumnDto
     */
    public function setData(string $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get column name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set column name.
     *
     * @param string $name Column name
     * @return ColumnDto
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Is column searchable?
     *
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * Set column searchable.
     *
     * @param bool $searchable Searchable
     * @return ColumnDto
     */
    public function setSearchable(bool $searchable): self
    {
        $this->searchable = $searchable;
        return $this;
    }

    /**
     * Is column orderable?
     *
     * @return bool
     */
    public function isOrderable(): bool
    {
        return $this->orderable;
    }

    /**
     * Set column orderable.
     *
     * @param bool $orderable Orderable
     * @return ColumnDto
     */
    public function setOrderable(bool $orderable): self
    {
        $this->orderable = $orderable;
        return $this;
    }

    /**
     * Get column search.
     *
     * @return SearchDto
     */
    public function getSearch(): SearchDto
    {
        return $this->search;
    }

    /**
     * Set column search.
     *
     * @param SearchDto $search Search
     * @return ColumnDto
     */
    public function setSearch(SearchDto $search): self
    {
        $this->search = $search;
        return $this;
    }
}