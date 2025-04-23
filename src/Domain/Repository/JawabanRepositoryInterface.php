<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Jawaban;
use App\Domain\ValueObject\JawabanId;

interface JawabanRepositoryInterface
{
    public function find(JawabanId $id): ?Jawaban;
    public function loadKelompokJawaban(Jawaban $jawaban);
    public function save(Jawaban $jawaban);
    public function destroy(Jawaban $jawaban);
}
