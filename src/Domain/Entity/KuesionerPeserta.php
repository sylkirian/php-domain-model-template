<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\KuesionerPesertaId;
use App\Domain\ValueObject\PengajarId;
use App\Domain\ValueObject\PesertaId;
use App\Domain\ValueObject\PilihanJawabanId;
use App\Helper\Error\ErrorEnum;
use DateTime;

class KuesionerPeserta
{
    public function __construct(
        private KuesionerPesertaId $id,
        private ?DateTime $waktuValidasi = null,
        private ?array $pilihanJawabanIdList = null,
        private ?Kuesioner $kuesioner = null,
    ) {}

    public function getWaktuValidasi(): ?DateTime
    {
        return $this->waktuValidasi;
    }

    public function getKuesioner(): Kuesioner
    {
        if (!isset($this->kuesioner)) {
            throw new InvalidArgumentException('Data kuesioner pada kuesioner peserta belum dimuat', ErrorEnum::KuesionerPesertaKuesionerUnloaded->value);
        }

        return $this->kuesioner;
    }

    public function isValid(): bool
    {
        return isset($this->waktuValidasi);
    }

    public function setPilihanJawabanIdList(array $pilihanJawabanIdList)
    {
        $this->pilihanJawabanIdList = $pilihanJawabanIdList;
    }

    public function setKuesioner(Kuesioner $kuesioner)
    {
        $this->kuesioner = $kuesioner;
    }

    public function validasi()
    {
        if ($this->waktuValidasi) {
            return;
        }

        $this->waktuValidasi = new DateTime;
    }

    public function batalValidasi()
    {
        if (!isset($this->waktuValidasi)) {
            return;
        }

        $this->waktuValidasi = null;
    }

    public static function create(PesertaId $pesertaId, PengajarId $pengajarId, Kuesioner $kuesioner, array $jawabanMap): KuesionerPeserta
    {
        if (!$kuesioner->isKuesionerKelasAktif()) {
            throw new InvalidArgumentException('Kuesioner bukan merupakan kuesioner kelas yang aktif', ErrorEnum::KuesionerPesertaTidakAktif->value);
        }
        if ($pesertaId->getKelasId() != $pengajarId->getKelasId()) {
            throw new InvalidArgumentException('Mahasiswa tidak bisa mengisi kuesioner untuk dosen ini', ErrorEnum::KuesionerPesertaBedaKelas->value);
        }

        return new KuesionerPeserta(
            id: new KuesionerPesertaId(
                pesertaId: $pesertaId,
                pengajarId: $pengajarId,
                kuesionerId: $kuesioner->getId(),
            ),
            pilihanJawabanIdList: self::buildPilihanJawabanIdList($kuesioner, $jawabanMap),
        );
    }

    public function update(array $jawabanMap)
    {
        if ($this->isValid()) {
            throw new InvalidArgumentException('Kuesioner tidak bisa diubah karena sudah valid', ErrorEnum::KuesionerPesertaSudahAktif->value);
        }

        $this->pilihanJawabanIdList = self::buildPilihanJawabanIdList($this->getKuesioner(), $jawabanMap);
    }

    private static function buildPilihanJawabanIdList(Kuesioner $kuesioner, array $jawabanMap)
    {
        foreach ($kuesioner->getPertanyaanList() as $pertanyaan) {
            $nomorPertanyaan = $pertanyaan->getId()->getNomorPertanyaan()->getNomor();

            $jawaban = $jawabanMap[$nomorPertanyaan];
            $jawabanId = $jawaban->getId();

            $found = false;
            foreach ($pertanyaan->getKelompokJawaban()->getJawabanList() as $jawabanPertanyaan) {
                if ($jawabanId->equals($jawabanPertanyaan->getId())) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                throw new InvalidArgumentException('Jawaban ' . $jawaban->getJawaban() . ' tidak ada pada pertanyaan nomor ' . $nomorPertanyaan, ErrorEnum::KuesionerPesertaJawabanTidakValid->value);
            }

            $pilihanJawabanIdList[] = new PilihanJawabanId(
                pertanyaanId: $pertanyaan->getId(),
                jawabanId: $jawabanId,
            );
        }

        return $pilihanJawabanIdList;
    }
}
