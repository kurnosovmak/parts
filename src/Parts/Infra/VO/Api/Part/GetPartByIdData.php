<?php

namespace Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part;

use Kurnosovmak\Parts\Parts\Infra\Exceptions\ErrorDataException;

class GetPartByIdData
{

    /**
     * @throws ErrorDataException
     */
    public static function create(int $partId): self
    {
        if ($partId <= 0) {
            throw new ErrorDataException('GetPartByData.create');
        }
        return new self($partId);
    }


    private function __construct(
        private readonly int $partId,
    )
    {
    }

    public function getPartId(): int
    {
        return $this->partId;
    }
}