<?php

namespace Kurnosovmak\Parts\Parts\Infra\Vo\Api;

use Kurnosovmak\Parts\Parts\Infra\Exceptions\ErrorDataException;

class CursorData
{

    private const MAX_LIMIT = 200;

    /**
     * @throws ErrorDataException
     */
    public static function create(int $offset, int $limit = 20): self
    {
        if ($offset < 0) {
            throw new ErrorDataException('CursorData.create');
        }

        if ($limit <= 0 || $limit > self::MAX_LIMIT) {
            throw new ErrorDataException('CursorData.create');
        }
        return new self($offset, $limit);
    }


    private function __construct(
        private readonly int $offset,
        private readonly int $limit,
    )
    {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}