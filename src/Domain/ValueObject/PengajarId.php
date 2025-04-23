<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class PengajarId
{
    public function __construct(
        private KelasId $kelasId,
        private DosenId $dosenId,
    ) {}

    public function getKelasId(): KelasId
    {
        return $this->kelasId;
    }
}
