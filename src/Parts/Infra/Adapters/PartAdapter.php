<?php

namespace Kurnosovmak\Parts\Parts\Infra\Adapters;

use Kurnosovmak\Parts\Parts\Domain\Entities\Part;
use Kurnosovmak\Parts\Parts\Domain\Entities\PartCreate;
use Kurnosovmak\Parts\Parts\Domain\Exceptions\NotUniqException;
use Kurnosovmak\Parts\Parts\Domain\Services\PartService;
use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;
use Kurnosovmak\Parts\Parts\Infra\Exceptions\ErrorDataException;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\CursorData;

class PartAdapter
{
    public function __construct(
        private readonly PartService $partService,
    )
    {
    }

    /**
     * @return array{0: Part[], 1: int }
     * @throws ErrorDataException
     */
    public function get(int $offset, int $limit): array
    {
        return $this->partService->get(CursorData::create($offset, $limit));
    }

    public function getPartById(int $id): ?Part
    {
        return $this->partService->getById(new PartId($id));
    }

    public function getPartBySlug(string $slug): ?Part
    {
        return $this->partService->getBySlug(new PartSlug($slug));
    }

    /**
     * @return Part[]
     */
    public function search(string $text): array
    {
        return $this->partService->search($text);
    }


    /**
     * @throws NotUniqException
     */
    public function create(string $partSlug): Part
    {
        return $this->partService->create(new PartCreate(
            slug: new PartSlug($partSlug),
        ));
    }
}