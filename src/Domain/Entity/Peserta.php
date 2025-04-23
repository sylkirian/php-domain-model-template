<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\PesertaId;

class Peserta
{
    public function __construct(
        private PesertaId $id,
    ) {}

    public function getId(): PesertaId
    {
        return $this->id;
    }
}
