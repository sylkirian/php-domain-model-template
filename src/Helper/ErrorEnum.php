<?php

declare(strict_types=1);

namespace App\Helper\Error;

enum ErrorEnum: int
{
    // value object
    case NomorUrutInvalid = 10101;
    case BobotJawabanInvalid = 10201;
    case JenisKuesionerInvalid = 10301;

    // entity
    case KuesionerDipakaiUnloaded = 20101;
    case KuesionerJumlahPertanyaanUnloaded = 20102;
    case KuesionerDaftarPertanyaanUnloaded = 20103;
    case KuesionerDipakai = 20104;

    case PertanyaanKelompokJawabanUnloaded = 20201;
    case PertanyaanKuesionerUnloaded = 20202;

    case KelompokJawabanDipakaiUnloaded = 20301;
    case KelompokJawabanJumlahJawabanUnloaded = 20302;
    case KelompokJawabanDaftarJawabanUnloaded = 20303;
    case KelompokJawabanDipakai = 20304;

    case JawabanKelompokJawabanUnloaded = 20401;

    case KuesionerPesertaKuesionerUnloaded = 20501;
    case KuesionerPesertaTidakAktif = 20502;
    case KuesionerPesertaBedaKelas = 20503;
    case KuesionerPesertaSudahValid = 20504;
    case KuesionerPesertaJawabanTidakValid = 20505;
}