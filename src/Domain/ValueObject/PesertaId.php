<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class PesertaId
{
    public function __construct(
        private KelasId $kelasId,
        private MahasiswaId $mahasiswaId,
    ) {}

    public function getKelasId(): KelasId
    {
        return $this->kelasId;
    }
}
