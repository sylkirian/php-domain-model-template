<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Helper\Error\ErrorEnum;
use Exception;
use InvalidArgumentException;

enum JenisKuesionerEnum: string
{
    case Kelas = 'K';
}

class JenisKuesioner
{
    private JenisKuesionerEnum $jenisKuesioner;

    public function __construct(string $jenisKuesioner)
    {
        try {
            $this->jenisKuesioner = JenisKuesionerEnum::from($jenisKuesioner);
        } catch (Exception) {
            throw new InvalidArgumentException('Jenis kuesioner tidak bisa berisi ' . $jenisKuesioner, ErrorEnum::JenisKuesionerInvalid->value);
        }
    }

    public function getJenisKuesioner(): JenisKuesionerEnum
    {
        return $this->jenisKuesioner;
    }
}
