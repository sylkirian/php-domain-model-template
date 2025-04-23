<?php

declare(strict_types=1);

namespace Tests\Domain\Service;

use App\Domain\Entity\KuesionerPeserta;
use App\Domain\Service\ValidasiKuesionerPesertaService;
use App\Domain\ValueObject\KuesionerPesertaId;
use DateTime;
use PHPUnit\Framework\TestCase;

class ValidasiKuesionerPesertaServiceTest extends TestCase
{
    public function testValidasiSemuaKuesionerPeserta()
    {
        $dt = DateTime::createFromFormat('Y-m-d', '2025-02-25');
        $list = [
            $this->makeKuesionerPeserta(),
            $this->makeKuesionerPeserta($dt),
            $this->makeKuesionerPeserta(),
        ];

        ValidasiKuesionerPesertaService::validasiSemuaKuesionerPeserta($list);

        $this->assertTrue($list[0]->isValid());
        $this->assertEquals($dt, $list[1]->getWaktuValidasi());
        $this->assertNotEquals($dt, $list[2]->getWaktuValidasi());
    }

    private function makeKuesionerPeserta($waktuValidasi = null)
    {
        /**
         * @var KuesionerPesertaId
         */
        $id = $this->createMock(KuesionerPesertaId::class);

        return new KuesionerPeserta(
            id: $id,
            waktuValidasi: $waktuValidasi,
        );
    }
}
