<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\BobotJawaban;
use App\Domain\ValueObject\JawabanId;
use App\Domain\ValueObject\JawabanText;
use App\Domain\ValueObject\NomorJawaban;
use App\Helper\Error\ErrorEnum;

class Jawaban
{
    public function __construct(
        private JawabanId $id,
        private JawabanText $text,
        private BobotJawaban $bobot,
        private ?KelompokJawaban $kelompokJawaban = null,
    ) {}

    public function getJawaban(): JawabanText
    {
        return $this->jawaban;
    }

    public function getKelompokJawaban(): KelompokJawaban
    {
        if (!isset($this->kelompokJawaban)) {
            throw new InvalidArgumentException('Data kelompok jawaban pada jawaban belum dimuat', ErrorEnum::JawabanKelompokJawabanUnloaded->value);
        }

        return $this->kelompokJawaban;
    }

    public static function create(KelompokJawaban $kelompokJawaban, JawabanText $text, BobotJawaban $bobot)
    {
        if ($kelompokJawaban->getIsDipakai()) {
            throw new InvalidArgumentException('Jawaban tidak bisa ditambahkan karena kelompok jawaban sudah digunakan', ErrorEnum::KelompokJawabanDipakai->value);
        }

        return new self(
            id: new JawabanId(
                kelompokJawabanId: $kelompokJawaban->getId(),
                nomorJawaban: new NomorJawaban($kelompokJawaban->getJumlahJawaban() + 1),
            ),
            text: $text,
            bobot: $bobot,
        );
    }

    public function update(JawabanText $text, BobotJawaban $bobot)
    {
        if ($this->getKelompokJawaban()->getIsDipakai()) {
            throw new InvalidArgumentException('Jawaban tidak bisa diubah karena kelompok jawaban sudah digunakan', ErrorEnum::KelompokJawabanDipakai->value);
        }

        $this->text = $text;
        $this->bobot = $bobot;
    }
}
