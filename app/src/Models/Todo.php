<?php declare(strict_types=1);

namespace App\Models;

/**
 * To Do model.
 */
class Todo extends Model
{
    /**
     * @var string Table name.
     */
    public string $tableName = 'todo';

    /**
     * @var array|string[] Searchable columns.
     */
    public array $searchableColumns = [
        'name',
        'email',
        'text',
    ];
}