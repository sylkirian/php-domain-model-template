<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\KelompokJawaban;
use App\Domain\ValueObject\KelompokJawabanId;

interface KelompokJawabanRepositoryInterface
{
    public function find(KelompokJawabanId $id): ?KelompokJawaban;
    public function loadIsDipakai(KelompokJawaban $kelompokJawaban);
    public function loadJumlahJawaban(KelompokJawaban $kelompokJawaban);
    public function loadJawabanList(KelompokJawaban $kelompokJawaban);
    public function save(KelompokJawaban $kelompokJawaban);
    public function destroy(KelompokJawaban $kelompokJawaban);
}
