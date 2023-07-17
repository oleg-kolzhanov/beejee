<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * Трансформер отзыва.
 */
class ToDoTransformer extends AbstractArrayTransformer
{
    /**
     * Трансформирует массив в dto.
     *
     * @param array $data
     * @return TodoDto
     * @throws Throwable
     */
    public function transform(array $data): TodoDto
    {
        $this->assertFieldExist('name', $data);
        $this->assertFieldExist('email', $data);
        $this->assertFieldExist('text', $data);

        return new TodoDto(
            $data['name'],
            $data['email'],
            $data['text'],
        );
    }
}