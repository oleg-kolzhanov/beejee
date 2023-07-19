<?php declare(strict_types=1);

namespace App\Dto;

use App\App;
use Throwable;

/**
 * Column data transformer.
 */
class ColumnTransformer extends AbstractArrayTransformer
{
    /**
     * Transform column data to dto.
     *
     * @param array $data Column data
     * @return ColumnDto
     * @throws Throwable
     */
    public function transform(array $data): ColumnDto
    {
        $this->assertFieldExist('data', $data);
        $this->assertFieldExist('name', $data);
        $this->assertFieldExist('searchable', $data);
        $this->assertFieldExist('orderable', $data);
        $this->assertFieldExist('search', $data);

        $container = App::getInstance()->getContainer();

        /** @var SearchTransformer $searchTransformer */
        $searchTransformer = $container->make(SearchTransformer::class);

        return new ColumnDto(
            $data['data'],
            $data['name'],
            (bool) $data['searchable'],
            (bool) $data['orderable'],
            $searchTransformer->transform($data['search']),
        );
    }
}