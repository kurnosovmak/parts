<?php

namespace Kurnosovmak\Parts\Parts\Domain\VO;

class PartSlug
{
    public function __construct(private readonly string $partSlug)
    {
    }

    public function getValue(): string
    {
        return $this->partSlug;
    }
}