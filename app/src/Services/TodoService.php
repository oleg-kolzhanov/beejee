<?php declare(strict_types=1);

namespace App\Services;

use App\Dto\OrderDto;
use App\Dto\RequestDto;
use App\Dto\TodoDto;
use App\Models\Todo;

class TodoService
{

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

    public function create(TodoDto $todoDto): ?bool
    {
        $todo = new Todo();

        return $todo->insert([
            'name' => $todoDto->getName(),
            'email' => $todoDto->getEmail(),
            'text' => $todoDto->getText()
        ]);
    }

    private function format(array $data): array
    {
        $result = [];
        foreach ($data as $value) {
            $result[] = [
                $value->name,
                $value->email,
                $value->text,
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