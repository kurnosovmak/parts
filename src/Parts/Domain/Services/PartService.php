<?php

namespace Kurnosovmak\Parts\Parts\Domain\Services;


use Kurnosovmak\Parts\Parts\Domain\Entities\Part;
use Kurnosovmak\Parts\Parts\Domain\Entities\PartCreate;
use Kurnosovmak\Parts\Parts\Domain\Exceptions\NotUniqException;
use Kurnosovmak\Parts\Parts\Domain\Repository\PartRepository;
use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\CursorData;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part\CreateData;

class PartService
{
    public function __construct(
        private readonly PartRepository $partRepository,
    )
    {
    }

    public function getById(PartId $partId): ?Part
    {
        return $this->partRepository->getById($partId);
    }

    public function getBySlug(PartSlug $partSlug): ?Part
    {
        return $this->partRepository->getBySlug($partSlug);
    }

    /**
     * @return Part[]
     */
    public function search(string $searchText): array
    {
        return $this->partRepository->search($searchText);
    }

    /**
     * @return array{0: Part[], 1: int} // pars, all count
     */
    public function get(CursorData $cursor): array
    {
        $parts = $this->partRepository->all($cursor->getOffset(), $cursor->getLimit());

        $count = $this->partRepository->allCount();

        return [$parts, $count];
    }

    /**
     * @throws NotUniqException
     */
    public function create(PartCreate $createData): Part
    {
        return $this->partRepository->create($createData);
    }
}