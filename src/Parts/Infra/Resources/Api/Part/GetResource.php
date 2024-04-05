<?php

namespace Kurnosovmak\Parts\Parts\Infra\Resources\Api\Parts;

use Illuminate\Http\Resources\Json\JsonResource;
use Kurnosovmak\Parts\Parts\Domain\Entities\Part;
use Kurnosovmak\Parts\Parts\Infra\Resources\Api\Objects\PartConverter;

class GetResource extends JsonResource
{
    /**
     * @param Part[] $parts
     */
    public function __construct(
        private readonly array $parts,
        private readonly int   $count,
    )
    {
        parent::__construct($parts);
    }


    public function toArray($request): array
    {
        return [
            'count' => $this->count,
            'parts' => PartConverter::convertPartsToArray($this->parts)
        ];
    }
}