<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

abstract class LocaleString
{
    public function __construct(
        private string $str,
        private ?string $strEnglish = null,
    ) {}

    public function getStr(): string
    {
        return $this->str;
    }

    public function getStrEnglish(): ?string
    {
        return $this->strEnglish;
    }
}
