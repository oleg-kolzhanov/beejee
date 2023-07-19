<?php declare(strict_types=1);

namespace App\Services;

use App\App;
use App\Dto\OrderDto;
use App\Dto\TodoListDto;
use App\Dto\TodoCreateDto;
use App\Dto\TodoUpdateDto;
use App\Models\Todo;
use DI\DependencyException;
use DI\NotFoundException;

/**
 * To Do Service.
 */
class TodoService
{
    /**
     * Find To Do by identity.
     *
     * @param int $id To Do identity
     * @return mixed
     */
    public function find(int $id): mixed
    {
        $todo = new Todo();
        return $todo->find($id);
    }

    /**
     * Return To Do rows list.
     *
     * @param TodoListDto $todoListDto To Do list DTO
     * @return array
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function get(TodoListDto $todoListDto): array
    {
        $todo = new Todo();

        $recordsTotal = $todo->total();

        $recordsFiltered = $todo->query()
            ->select()
            ->count();

        $query = $todo->query()
            ->limit($todoListDto->getLength())
            ->offset($todoListDto->getStart());

        foreach ($todoListDto->getOrder() as $order) {
            /** @var OrderDto $order */
            $column = $this->getColumnName($order);
            $dir = $this->getDir($order);

            $query = $query->orderBy($column, $dir);
        }

        $search = $todoListDto->getSearch();
        $value = $search->getValue();
        if ($value) {
            $searchableColumns = $todo->getSearchableColumns();
            $first = true;
            foreach ($searchableColumns as $column) {
                if ($first) {
                    $query->where($column)->like('%' . $value . '%');
                    $first = false;
                } else {
                    $query->orWhere($column)->like('%' . $value . '%');
                }
            }
        }

        $data = $query->select()->all();

        return [
            "draw" => $todoListDto->getDraw(),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            'data' => $this->format($data),
        ];
    }

    /**
     * Create To Do.
     *
     * @param TodoCreateDto $todoDto To Do create DTO
     * @return bool|null
     */
    public function create(TodoCreateDto $todoDto): ?bool
    {
        $todo = new Todo();

        return $todo->insert([
            'name' => $todoDto->getName(),
            'email' => $todoDto->getEmail(),
            'text' => $todoDto->getText()
        ]);
    }

    /**
     * Update To Do.
     *
     * @param int $id To Do identity
     * @param TodoUpdateDto $todoDto To Do update DTO
     * @return int
     */
    public function update(int $id, TodoUpdateDto $todoDto): int
    {
        $todo = new Todo();

        return $todo->update($id, [
            'text' => $todoDto->getText(),
            'done' => $todoDto->isDone() ? 1 : 0,
        ]);
    }

    /**
     * Format To Do rows list data.
     *
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function format(array $data): array
    {
        $authService = App::getInstance()->getContainer()->make('App\Services\AuthService');

        $result = [];
        foreach ($data as $value) {
            $result[] = [
                'id' => $value->id,
                'name' => $value->name,
                'email' => $value->email,
                'text' => $value->text,
                'done' => $value->done ? 'true' : 'false',
            ];
        }
        return$result;
    }

    /**
     * Get order column name.
     *
     * @param OrderDto $order Order
     * @return string
     */
    private function getColumnName(OrderDto $order): string
    {
        $column = 'id';

        switch ($order->getColumn()) {
            case 0:
                $column = 'name';
                break;
            case 1:
                $column = 'email';
                break;
            case 2:
                $column = 'text';
                break;
            case 3:
                $column = 'done';
                break;
        }
        return $column;
    }

    /**
     * Get order direction.
     *
     * @param OrderDto $order Order
     * @return string
     */
    public function getDir(OrderDto $order): string
    {
        return $order->getDir() === 'desc' ? 'DESC' : 'ASC';
    }
}