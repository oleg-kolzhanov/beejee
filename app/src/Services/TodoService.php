<?php declare(strict_types=1);

namespace App\Services;

use App\App;
use App\Dto\OrderDto;
use App\Dto\RequestDto;
use App\Dto\TodoCreateDto;
use App\Dto\TodoUpdateDto;
use App\Models\Todo;
use DI\DependencyException;
use DI\NotFoundException;

class TodoService
{
    public function find(int $id): mixed
    {
        $todo = new Todo();
        return $todo->find($id);
    }

    public function get(RequestDto $requestDto): array
    {
        $todo = new Todo();

        $recordsTotal = $todo->count();

        $recordsFiltered = $todo->query()
            ->select()
            ->count();

        $query = $todo->query()
            ->limit($requestDto->getLength())
            ->offset($requestDto->getStart());

        foreach ($requestDto->getOrder() as $order) {
            /** @var OrderDto $order */
            $column = $this->getColumnName($order);
            $dir = $this->getDir($order);

            $query = $query->orderBy($column, $dir);
        }

        $search = $requestDto->getSearch();
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
            "draw" => $requestDto->getDraw(),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            'data' => $this->format($data),
        ];
    }

    public function create(TodoCreateDto $todoDto): ?bool
    {
        $todo = new Todo();

        return $todo->insert([
            'name' => $todoDto->getName(),
            'email' => $todoDto->getEmail(),
            'text' => $todoDto->getText()
        ]);
    }

    public function update(int $id, TodoUpdateDto $todoDto)
    {
        $todo = new Todo();

        return $todo->update($id, [
            'text' => $todoDto->getText(),
            'done' => $todoDto->isDone() ? 1 : 0,
        ]);
    }

    /**
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
     * @param OrderDto $order
     * @return string
     */
    public function getDir(OrderDto $order): string
    {
        return $order->getDir() === 'desc' ? 'DESC' : 'ASC';
    }
}