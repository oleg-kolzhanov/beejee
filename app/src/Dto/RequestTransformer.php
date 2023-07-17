<?php declare(strict_types=1);

namespace App\Dto;

use App\App;
use Throwable;
use function DI\create;

/**
 * Request transformer.
 */
class RequestTransformer extends AbstractArrayTransformer
{
    /**
     * Трансформирует массив в dto.
     *
     * @param array $data
     * @return RequestDto
     * @throws Throwable
     */
    public function transform(array $data): RequestDto
    {
        $this->assertFieldExist('draw', $data);
        $this->assertFieldExist('columns', $data);
        $this->assertFieldExist('order', $data);
        $this->assertFieldExist('start', $data);
        $this->assertFieldExist('length', $data);
        $this->assertFieldExist('search', $data);

        $container = App::getInstance()->getContainer();

        /** @var ColumnTransformer $columnTransformer */
        $columnTransformer = $container->make(ColumnTransformer::class);

        /** @var OrderTransformer $orderTransformer */
        $orderTransformer = $container->make(OrderTransformer::class);

        /** @var SearchTransformer $searchTransformer */
        $searchTransformer = $container->make(SearchTransformer::class);

        $columns = [];
        foreach ($data['columns'] as $column) {
            $columns[] = $columnTransformer->transform($column);
        }

        $orders = [];
        foreach ($data['order'] as $order) {
            $orders[] = $orderTransformer->transform($order);
        }

        return new RequestDto(
            (int) $data['draw'],
            $columns,
            $orders,
            (int) $data['start'],
            (int) $data['length'],
            $searchTransformer->transform($data['search']),
        );
    }
}