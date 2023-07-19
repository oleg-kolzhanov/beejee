<?php declare(strict_types=1);

namespace App\Models;

use App\App;
use Opis\Database\Database;
use Opis\Database\SQL\Query;

/**
 * Base model.
 */
class Model
{
    /**
     * @var string Table name.
     */
    public string $tableName;

    /**
     * @var array|string[] Searchable columns.
     */
    public array $searchableColumns = [];

    /**
     * @var Database Database instance.
     */
    private Database $db;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->db = App::getInstance()->getDb();
    }

    /**
     * Find row by identity.
     *
     * @param int $id Row identity
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return $this->db->from($this->tableName)->where('id')->is($id)->select()->first();
    }

    /**
     * Total rows count.
     *
     * @return int
     */
    public function total(): int
    {
        return $this->db->from($this->tableName)->count();
    }

    /**
     * Return query.
     *
     * @return Query
     */
    public function query(): Query
    {
        return $this->db->from($this->tableName);
    }

    /**
     * Insert row.
     *
     * @param array $data Row data
     * @return bool|null
     */
    public function insert(array $data): ?bool
    {
        return $this->db->insert($data)->into($this->tableName);
    }

    /**
     * Update row.
     *
     * @param int $id Row identity
     * @param array $data Row data
     * @return int
     */
    public function update(int $id, array $data): int
    {
        return $this->db->update($this->tableName)->where('id')->is($id)->set($data);
    }

    /**
     * Return searchable columns.
     *
     * @return array|string[]
     */
    public function getSearchableColumns(): array
    {
        return $this->searchableColumns;
    }
}