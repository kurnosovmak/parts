<?php

namespace Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part;

use Kurnosovmak\Parts\Parts\Infra\Exceptions\ErrorDataException;

class SearchData
{

    /**
     * @throws ErrorDataException
     */
    public static function create(string $searchText): self
    {
        if (strlen(trim($searchText)) === 0) {
            throw new ErrorDataException('SearchData.create');
        }
        return new self($searchText);
    }


    private function __construct(
        private readonly string $searchText,
    )
    {
    }

    public function getText(): string
    {
        return $this->searchText;
    }
}