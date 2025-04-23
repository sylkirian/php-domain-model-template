<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

abstract class SerialId
{
    public function __construct(private int $id) {}

    public function equals(SerialId $id): bool
    {
        return $this->id === $id->getId();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
