<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class PilihanJawabanId
{
    public function __construct(
        private PertanyaanId $pertanyaanId,
        private JawabanId $jawabanId,
    ) {}

    public function getPertanyaanId(): PertanyaanId
    {
        return $this->pertanyaanId;
    }

    public function getJawabanId(): JawabanId
    {
        return $this->jawabanId;
    }
}
