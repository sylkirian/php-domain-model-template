<?php

declare(strict_types=1);

namespace App\Domain\Service;

class ValidasiKuesionerPesertaService
{
    // lebih cepat pakai query semacam "where idkelas = ? and isvalid = 0"
    public static function validasiSemuaKuesionerPeserta(array $kuesionerPesertaList)
    {
        foreach ($kuesionerPesertaList as $kuesionerPeserta) {
            $kuesionerPeserta->validasi();
        }
    }
}
