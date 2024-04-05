<?php

namespace Kurnosovmak\Parts\Parts\Infra\Repository\Converters;

use Kurnosovmak\Parts\Parts\Domain\Entities\Part;
use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;
use Kurnosovmak\Parts\Parts\Infra\Models\Part as PartModel;

class PartEloquentConverter
{
    public function convertModelToDomain(PartModel $partModel): Part
    {
        return new Part(
            id: new PartId($partModel->id),
            slug: new PartSlug($partModel->slug),
        );
    }

    /**
     * @param PartModel[] $partModels
     * @return Part[]
     */
    public function convertModelsToDomains(array $partModels): array
    {
        $parts = [];
        foreach ($partModels as $partModel) {
            $parts[] = $this->convertModelToDomain($partModel);
        }
        return $parts;
    }
}