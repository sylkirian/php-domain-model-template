<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\KuesionerPeserta;
use App\Domain\ValueObject\KuesionerPesertaId;

interface KuesionerPesertaRepositoryInterface
{
    public function find(KuesionerPesertaId $id): ?KuesionerPeserta;
    public function loadPilihanJawabanIdList(KuesionerPeserta $kuesionerPeserta);
    public function loadKuesioner(KuesionerPeserta $kuesionerPeserta);
    public function save(KuesionerPeserta $kuesionerPeserta);
    public function destroy(KuesionerPeserta $kuesionerPeserta);
}
