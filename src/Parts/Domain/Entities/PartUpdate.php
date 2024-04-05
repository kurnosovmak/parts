<?php

namespace Kurnosovmak\Parts\Parts\Domain\Entities;

use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;

class PartUpdate
{
    public function __construct(
        private readonly ?PartSlug $slug,
    )
    {
    }

    public function getSlug(): ?PartSlug
    {
        return $this->slug;
    }

    public function isSlugUpdate(): bool
    {
        return $this->slug !== null;
    }
}
