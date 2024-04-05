<?php

namespace Kurnosovmak\Parts\Parts\Domain\Entities;

use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;

class Part
{
    public function __construct(
        private readonly PartId   $id,
        private readonly PartSlug $slug,
    )
    {
    }

    public function getId(): PartId
    {
        return $this->id;
    }

    public function getSlug(): PartSlug
    {
        return $this->slug;
    }
}
