<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * Трансформер отзыва.
 */
class ToDoUpdateTransformer extends AbstractArrayTransformer
{
    /**
     * Трансформирует массив в dto.
     *
     * @param array $data
     * @return TodoUpdateDto
     * @throws Throwable
     */
    public function transform(array $data): TodoUpdateDto
    {
        $this->assertFieldExist('text', $data);
        $this->assertFieldExist('done', $data);
        return new TodoUpdateDto(
            $data['text'],
            ($data['done'] === 'true'),
        );
    }
}