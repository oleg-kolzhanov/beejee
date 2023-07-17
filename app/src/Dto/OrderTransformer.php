<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * Order transformer.
 */
class OrderTransformer extends AbstractArrayTransformer
{
    /**
     * Трансформирует массив в dto.
     *
     * @param array $data
     * @return OrderDto
     * @throws Throwable
     */
    public function transform(array $data): OrderDto
    {
        $this->assertFieldExist('column', $data);
        $this->assertFieldExist('dir', $data);

        return new OrderDto(
            (int) $data['column'],
            $data['dir'],
        );
    }
}