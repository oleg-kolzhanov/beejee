<?php declare(strict_types=1);

namespace App\Models;

class Todo extends Model
{
    public string $tableName = 'todo';

    public array $searchableColumns = [
        'name',
        'email',
//        'text',
        'done',
    ];
}