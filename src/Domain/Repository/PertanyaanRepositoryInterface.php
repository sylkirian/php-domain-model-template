<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Pertanyaan;
use App\Domain\ValueObject\PertanyaanId;

interface PertanyaanRepositoryInterface
{
    public function find(PertanyaanId $id): ?Pertanyaan;
    public function loadKelompokJawaban(Pertanyaan $pertanyaan);
    public function save(Pertanyaan $pertanyaan);
    public function destroy(Pertanyaan $pertanyaan);
}
