<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Helper\Error\ErrorEnum;
use InvalidArgumentException;

class BobotJawaban
{
    const BOBOT_MAX = 10;

    private float $bobot;

    public function __construct(float $bobot)
    {
        if ($bobot < 0 || $bobot > self::BOBOT_MAX) {
            throw new InvalidArgumentException('Bobot jawaban kuesioner harus bernilai 0 s.d. ' . self::BOBOT_MAX, ErrorEnum::BobotJawabanInvalid->value);
        }

        $this->bobot = $bobot;
    }

    public function getBobot(): float
    {
        return $this->bobot;
    }
}
