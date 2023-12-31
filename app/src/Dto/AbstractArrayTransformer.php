<?php declare(strict_types=1);

namespace App\Dto;

use RuntimeException;
use Throwable;

/**
 * Abstract transformer.
 */
abstract class AbstractArrayTransformer
{
    /**
     * Request fields check.
     *
     * @param string $name Field name
     * @param array $data Request data
     * @return void
     * @throws Throwable
     */
    public function assertFieldExist(string $name, array $data): void
    {
        if (!isset($data[$name])) {
            throw new RuntimeException('Field' . ' ' . $name . ' ' . 'not filled.');
        }
    }
}