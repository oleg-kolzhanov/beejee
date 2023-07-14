<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * Трансформер отзыва.
 */
class LoginTransformer extends AbstractArrayTransformer
{
    /**
     * Трансформирует массив в dto.
     *
     * @param array $data
     * @return LoginDto
     * @throws Throwable
     */
    public function transform(array $data): LoginDto
    {
        $this->assertFieldExist('login', $data);
        $this->assertFieldExist('password', $data);

        return new LoginDto(
            $data['login'],
            $data['password'],
        );
    }
}