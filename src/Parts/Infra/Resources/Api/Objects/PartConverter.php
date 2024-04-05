<?php

namespace Kurnosovmak\Parts\Parts\Infra\Resources\Api\Objects;

use Kurnosovmak\Parts\Parts\Domain\Entities\Part;

class PartConverter
{
    public static function convertPartToArray(Part $part): array
    {
        return [
            'id' => $part->getId()->getValue(),
            'slug' => $part->getSlug()->getValue(),
        ];
    }

    public static function convertPartsToArray(array $parts): array
    {
        $partsArray = [];
        foreach ($parts as $part) {
            $partsArray[] = self::convertPartToArray($part);
        }
        return $partsArray;
    }

}