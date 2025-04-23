<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class PertanyaanId
{
    public function __construct(
        private KuesionerId $kuesionerId,
        private NomorPertanyaan $nomorPertanyaan,
    ) {}

    public function getKuesionerId(): KuesionerId
    {
        return $this->kuesionerId;
    }

    public function getNomorPertanyaan(): NomorPertanyaan
    {
        return $this->nomorPertanyaan;
    }
}
