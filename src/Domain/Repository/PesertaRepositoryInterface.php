<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Peserta;
use App\Domain\ValueObject\PesertaId;

interface PesertaRepositoryInterface
{
    public function find(PesertaId $id): ?Peserta;
}
