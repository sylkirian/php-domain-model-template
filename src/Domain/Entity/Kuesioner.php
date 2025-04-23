<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\JenisKuesioner;
use App\Domain\ValueObject\JenisKuesionerEnum;
use App\Domain\ValueObject\KuesionerId;
use App\Helper\Error\ErrorEnum;

class Kuesioner
{
    public function __construct(
        private KuesionerId $id,
        private string $nama,
        private JenisKuesioner $jenisKuesioner,
        private bool $isAktif,
        private ?bool $isDipakai = null,
        private ?int $jumlahPertanyaan = null,
        private ?array $pertanyaanList = null,
    ) {}

    public function getId(): KuesionerId
    {
        return $this->id;
    }

    public function getIsDipakai(): bool
    {
        if (!isset($this->isDipakai)) {
            throw new InvalidArgumentException('Data dipakai pada kuesioner belum dimuat', ErrorEnum::KuesionerDipakaiUnloaded->value);
        }

        return $this->isDipakai;
    }

    public function getJumlahPertanyaan(): int
    {
        if (!isset($this->jumlahPertanyaan)) {
            throw new InvalidArgumentException('Data jumlah pertanyaan pada kuesioner belum dimuat', ErrorEnum::KuesionerJumlahPertanyaanUnloaded->value);
        }

        return $this->jumlahPertanyaan;
    }

    public function getPertanyaanList(): array
    {
        if (!isset($this->pertanyaanList)) {
            throw new InvalidArgumentException('Data pertanyaan pada kuesioner belum dimuat', ErrorEnum::KuesionerDaftarPertanyaanUnloaded->value);
        }

        return $this->pertanyaanList;
    }

    public function isKuesionerKelasAktif()
    {
        return $this->isAktif && $this->jenisKuesioner == JenisKuesionerEnum::Kelas;
    }

    public function setIsDipakai(bool $isDipakai)
    {
        $this->isDipakai = $isDipakai;
    }

    public function setJumlahPertanyaan(int $jumlahPertanyaan)
    {
        $this->jumlahPertanyaan = $jumlahPertanyaan;
    }

    public function setPertanyaanList(array $pertanyaanList)
    {
        $this->pertanyaanList = $pertanyaanList;
    }

    public static function create(KuesionerId $id, string $nama, JenisKuesioner $jenisKuesioner, bool $isAktif = true)
    {
        return new self(
            id: $id,
            nama: $nama,
            jenisKuesioner: $jenisKuesioner,
            isAktif: $isAktif,
        );
    }

    public function update(string $nama, bool $isAktif)
    {
        $this->nama = $nama;
        $this->isAktif = $isAktif;
    }
}
