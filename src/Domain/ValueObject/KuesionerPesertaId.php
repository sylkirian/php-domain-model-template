<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class KuesionerPesertaId
{
    public function __construct(
        private PesertaId $pesertaId,
        private PengajarId $pengajarId,
        private KuesionerId $kuesionerId,
    ) {}

    public function getPesertaId(): PesertaId
    {
        return $this->pesertaId;
    }

    public function getPengajarId(): PengajarId
    {
        return $this->pengajarId;
    }

    public function getKuesionerId(): KuesionerId
    {
        return $this->kuesionerId;
    }
}
