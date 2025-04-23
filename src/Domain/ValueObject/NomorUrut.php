<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Helper\Error\ErrorEnum;

class NomorUrut
{
    public function __construct(
        private int $nomor
    ) {
        if ($this->nomor <= 0) {
            throw new InvalidArgumentException('Nomor urut tidak boleh bernilai kurang dari sama dengan 0', ErrorEnum::NomorUrutInvalid->value);
        }
    }

    public function getNomor(): int
    {
        return $this->nomor;
    }
}
