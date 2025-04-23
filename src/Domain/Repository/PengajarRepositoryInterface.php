<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Pengajar;
use App\Domain\ValueObject\PengajarId;

interface PengajarRepositoryInterface
{
    public function find(PengajarId $id): ?Pengajar;
}
