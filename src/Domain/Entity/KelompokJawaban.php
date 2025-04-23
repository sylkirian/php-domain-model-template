<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\KelompokJawabanId;
use App\Helper\Error\ErrorEnum;
use InvalidArgumentException;

class KelompokJawaban
{
    public function __construct(
        private KelompokJawabanId $id,
        private string $nama,
        private ?bool $isDipakai = null,
        private ?int $jumlahJawaban = null,
        private ?array $jawabanList = null,
    ) {}

    public function getId(): KelompokJawabanId
    {
        return $this->id;
    }

    public function getIsDipakai(): bool
    {
        if (!isset($this->isDipakai)) {
            throw new InvalidArgumentException('Data dipakai pada kelompok jawaban belum dimuat', ErrorEnum::KelompokJawabanDipakaiUnloaded->value);
        }

        return $this->isDipakai;
    }

    public function getJumlahJawaban(): int
    {
        if (!isset($this->jumlahJawaban)) {
            throw new InvalidArgumentException('Data jumlah jawaban pada kelompok jawaban belum dimuat', ErrorEnum::KelompokJawabanJumlahJawabanUnloaded->value);
        }

        return $this->jumlahJawaban;
    }

    public function getJawabanList(): bool
    {
        if (!isset($this->jawabanList)) {
            throw new InvalidArgumentException('Data daftar jawaban pada kelompok jawaban belum dimuat', ErrorEnum::KelompokJawabanDaftarJawabanUnloaded->value);
        }

        return $this->isDipakai;
    }

    public function setIsDipakai(bool $isDipakai)
    {
        $this->isDipakai = $isDipakai;
    }

    public function setJumlahJawaban(int $jumlahJawaban)
    {
        $this->jumlahJawaban = $jumlahJawaban;
    }

    public function setJawabanList(array $jawabanList)
    {
        $this->jawabanList = $jawabanList;
    }

    public static function create(KelompokJawabanId $id, string $nama)
    {
        return new self(
            id: $id,
            nama: $nama,
        );
    }

    public function update(string $nama)
    {
        $this->nama = $nama;
    }
}
