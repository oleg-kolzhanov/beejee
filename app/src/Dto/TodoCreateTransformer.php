<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * Трансформер отзыва.
 */
class ToDoCreateTransformer extends AbstractArrayTransformer
{
    /**
     * Трансформирует массив в dto.
     *
     * @param array $data
     * @return TodoCreateDto
     * @throws Throwable
     */
    public function transform(array $data): TodoCreateDto
    {
        $this->assertFieldExist('name', $data);
        $this->assertFieldExist('email', $data);
        $this->assertFieldExist('text', $data);

        return new TodoCreateDto(
            $data['name'],
            $data['email'],
            $data['text'],
        );
    }
}