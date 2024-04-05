<?php

namespace Kurnosovmak\Parts\Parts\Infra\Adapters;

use Illuminate\Support\Facades\Facade;
use Kurnosovmak\Parts\Parts\Domain\Entities\Part;

/**
 * @method static PartFacade get(int $offset, int $limit): array{0: Part[], 1: int }
 * @method static PartFacade getPartById(int $id): ?Part
 * @method static PartFacade getPartBySlug(string $slug): ?Part
 * @method static PartFacade search(string $text): array
 * @method static PartFacade create(string $partSlug): Part
 */
class PartFacade extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'part';
    }

}