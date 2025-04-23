<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Kuesioner;
use App\Domain\ValueObject\KuesionerId;

interface KuesionerRepositoryInterface
{
    public function find(KuesionerId $id): ?Kuesioner;
    public function loadIsDipakai(Kuesioner $kuesioner);
    public function loadJumlahPertanyaan(Kuesioner $kuesioner);
    public function loadPertanyaanList(Kuesioner $kuesioner);
    public function save(Kuesioner $kuesioner);
    public function destroy(Kuesioner $kuesioner);
}
