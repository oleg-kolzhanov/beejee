<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * To Do update transformer.
 */
class ToDoUpdateTransformer extends AbstractArrayTransformer
{
    /**
     * Transform To Do update data to dto.
     *
     * @param array $data To Do update data
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