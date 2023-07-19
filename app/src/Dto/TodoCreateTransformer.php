<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * To Do create transformer.
 */
class ToDoCreateTransformer extends AbstractArrayTransformer
{
    /**
     * Transform To Do create data to dto.
     *
     * @param array $data To Do create data
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