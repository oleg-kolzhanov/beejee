<?php declare(strict_types=1);

namespace App\Dto;

use Throwable;

/**
 * Log in data transformer.
 */
class LoginTransformer extends AbstractArrayTransformer
{
    /**
     * Transform log in data to dto.
     *
     * @param array $data Log in data
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