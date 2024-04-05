<?php

namespace Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part;

use Kurnosovmak\Parts\Parts\Infra\Exceptions\ErrorDataException;

class CreateData
{

    /**
     * @throws ErrorDataException
     */
    public static function create(string $slug): self
    {
        if (strlen(trim($slug)) === 0) {
            throw new ErrorDataException('CreateData.create');
        }
        return new self($slug);
    }


    private function __construct(
        private readonly string $slug,
    )
    {
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}