<?php declare(strict_types=1);

namespace App\Models;

use App\App;
use Opis\Database\Database;
use Opis\Database\SQL\Query;

class Model
{
    public string $tableName;

    public array $searchableColumns = [];

    private Database $db;

    public function __construct()
    {
        $this->db = App::getInstance()->getDb();
    }

    public function find(int $id): mixed
    {
        return $this->db->from($this->tableName)->where('id')->is($id)->select()->first();
    }

    public function count(): int
    {
        return $this->db->from($this->tableName)->count();
    }

    public function query(): Query
    {
        return $this->db->from($this->tableName);
    }

    public function insert(array $data): ?bool
    {
        return $this->db->insert($data)->into($this->tableName);
    }

    public function update(int $id, array $data): int
    {
        return $this->db->update($this->tableName)->where('id')->is($id)->set($data);
    }

    public function getSearchableColumns(): array
    {
        return $this->searchableColumns;
    }
}