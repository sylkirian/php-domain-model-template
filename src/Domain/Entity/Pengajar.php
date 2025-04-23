<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\PengajarId;

class Pengajar
{
    public function __construct(
        private PengajarId $id,
    ) {}

    public function getId(): PengajarId
    {
        return $this->id;
    }
}
