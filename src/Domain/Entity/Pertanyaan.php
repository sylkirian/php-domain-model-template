<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\KelompokJawabanId;
use App\Domain\ValueObject\NomorPertanyaan;
use App\Domain\ValueObject\PertanyaanId;
use App\Domain\ValueObject\PertanyaanText;

class Pertanyaan
{
    public function __construct(
        private PertanyaanId $id,
        private PertanyaanText $text,
        private KelompokJawabanId $kelompokJawabanId,
        private ?KelompokJawaban $kelompokJawaban = null,
        private ?Kuesioner $kuesioner = null,
    ) {}

    public function getId(): PertanyaanId
    {
        return $this->id;
    }

    public function getKelompokJawaban(): KelompokJawaban
    {
        if (!isset($this->kelompokJawaban)) {
            throw new InvalidArgumentException('Data kelompok jawaban pada pertanyaan belum dimuat', ErrorEnum::PertanyaanKelompokJawabanUnloaded->value);
        }

        return $this->kelompokJawaban;
    }

    public function getKuesioner(): Kuesioner
    {
        if (!isset($this->kuesioner)) {
            throw new InvalidArgumentException('Data kuesioner pada pertanyaan belum dimuat', ErrorEnum::PertanyaanKuesionerUnloaded->value);
        }

        return $this->kuesioner;
    }

    public function setKelompokJawaban(KelompokJawaban $kelompokJawaban)
    {
        $this->kelompokJawaban = $kelompokJawaban;
    }

    public static function create(Kuesioner $kuesioner, PertanyaanText $text, KelompokJawabanId $kelompokJawabanId)
    {
        if ($kuesioner->getIsDipakai()) {
            throw new InvalidArgumentException('Pertanyaan tidak bisa ditambahkan karena kuesioner sudah digunakan', ErrorEnum::KuesionerDipakai->value);
        }

        return new self(
            id: new PertanyaanId(
                kuesionerId: $kuesioner->getId(),
                nomorPertanyaan: new NomorPertanyaan($kuesioner->getJumlahPertanyaan() + 1),
            ),
            text: $text,
            kelompokJawabanId: $kelompokJawabanId,
        );
    }

    public function update(PertanyaanText $text, KelompokJawabanId $kelompokJawabanId)
    {
        if ($this->getKuesioner()->getIsDipakai()) {
            throw new InvalidArgumentException('Pertanyaan tidak bisa diubah karena kuesioner sudah digunakan', ErrorEnum::KuesionerDipakai->value);
        }

        $this->text = $text;
        $this->kelompokJawabanId = $kelompokJawabanId;
    }
}
