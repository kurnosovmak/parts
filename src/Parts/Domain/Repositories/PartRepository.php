<?php

namespace Kurnosovmak\Parts\Parts\Domain\Repository;

use Kurnosovmak\Parts\Parts\Domain\Entities\Part;
use Kurnosovmak\Parts\Parts\Domain\Entities\PartCreate;
use Kurnosovmak\Parts\Parts\Domain\Entities\PartUpdate;
use Kurnosovmak\Parts\Parts\Domain\Exceptions\NotUniqException;
use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;

interface PartRepository
{
    public function getById(PartId $partId): ?Part;

    public function getBySlug(PartSlug $partSlug): ?Part;

    /**
     * @return Part[]
     */
    public function search(string $searchText): array;

    /**
     * @return Part[]
     */
    public function all(int $offset, int $limit): array;

    public function allCount(): int;

    /**
     * @throws NotUniqException
     */
    public function create(PartCreate $partCreate): Part;

    /**
     * @throws NotUniqException
     */
    public function update(PartUpdate $partUpdate): Part;

}