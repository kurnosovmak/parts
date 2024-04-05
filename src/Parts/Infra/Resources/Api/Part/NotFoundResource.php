<?php

use Illuminate\Http\Resources\Json\JsonResource;
use Kurnosovmak\Parts\Parts\Domain\Entities\Part;

class NotFoundResource extends JsonResource
{

    public function __construct()
    {
        parent::__construct([]);
    }

    public function withResponse($request, $response): void
    {
        $response->setStatusCode(404, 'Not found');
    }

    public function toArray($request): array
    {
        return [];
    }
}