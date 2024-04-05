<?php

namespace Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part;

use Kurnosovmak\Parts\Parts\Infra\Exceptions\ErrorDataException;

class GetPartBySlugData
{

    /**
     * @throws ErrorDataException
     */
    public static function create(string $partSlug): self
    {
        if (strlen(trim($partSlug)) === 0) {
            throw new ErrorDataException('GetPartByData.create');
        }
        return new self($partSlug);
    }


    private function __construct(
        private readonly string $partSlug,
    )
    {
    }

    public function getPartSlug(): string
    {
        return $this->partSlug;
    }
}