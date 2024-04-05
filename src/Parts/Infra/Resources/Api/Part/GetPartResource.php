<?php

use Illuminate\Http\Resources\Json\JsonResource;
use Kurnosovmak\Parts\Parts\Domain\Entities\Part;
use Kurnosovmak\Parts\Parts\Infra\Resources\Api\Objects\PartConverter;

class GetPartResource extends JsonResource
{
    public function __construct(private readonly Part $part)
    {
        parent::__construct($part);
    }


    public function toArray($request): array
    {
        return PartConverter::convertPartToArray($this->part);
    }
}