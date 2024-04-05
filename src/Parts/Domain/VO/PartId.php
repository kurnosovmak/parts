<?php

namespace Kurnosovmak\Parts\Parts\Domain\VO;

class PartId
{
    public function __construct(private readonly int $partId)
    {
    }

    public function getValue(): int
    {
        return $this->partId;
    }
}