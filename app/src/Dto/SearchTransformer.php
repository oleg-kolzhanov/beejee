<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * Search transformer.
 */
class SearchTransformer extends AbstractArrayTransformer
{
    /**
     * Трансформирует массив в dto.
     *
     * @param array $data
     * @return SearchDto
     * @throws Throwable
     */
    public function transform(array $data): SearchDto
    {
        $this->assertFieldExist('value', $data);
        $this->assertFieldExist('regex', $data);

        return new SearchDto(
            $data['value'],
            (bool) $data['regex'],
        );
    }
}