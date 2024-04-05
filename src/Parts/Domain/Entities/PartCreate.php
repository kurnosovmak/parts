<?php

namespace Kurnosovmak\Parts\Parts\Domain\Entities;

use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;

class PartCreate
{
    public function __construct(
        private readonly PartSlug $slug,
    )
    {
    }

    public function getSlug(): PartSlug
    {
        return $this->slug;
    }
}
