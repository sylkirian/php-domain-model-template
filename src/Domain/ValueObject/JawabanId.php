<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class JawabanId
{
    public function __construct(
        private KelompokJawabanId $kelompokJawabanId,
        private NomorJawaban $nomorJawaban,
    ) {}

    public function getKelompokJawabanId(): KelompokJawabanId
    {
        return $this->kelompokJawabanId;
    }

    public function getNomorJawaban(): NomorJawaban
    {
        return $this->nomorJawaban;
    }
}
