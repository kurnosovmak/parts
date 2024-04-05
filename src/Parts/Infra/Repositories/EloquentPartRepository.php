<?php

namespace Kurnosovmak\Parts\Parts\Infra\Repository;

use Illuminate\Database\Eloquent\Builder;
use Kurnosovmak\Parts\Parts\Domain\Entities\Part;
use Kurnosovmak\Parts\Parts\Infra\Models\Part as PartModel;
use Kurnosovmak\Parts\Parts\Domain\Entities\PartCreate;
use Kurnosovmak\Parts\Parts\Domain\Entities\PartUpdate;
use Kurnosovmak\Parts\Parts\Domain\Repository\PartRepository;
use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;
use Kurnosovmak\Parts\Parts\Infra\Repository\Converters\PartEloquentConverter;
use RuntimeException;

class EloquentPartRepository implements PartRepository
{
    public function __construct(
        private readonly PartModel             $partModel,
        private readonly PartEloquentConverter $converter,
    )
    {
    }

    public function getById(PartId $partId): ?Part
    {
        /** @var PartModel $partModel */
        $partModel = $this->getQuery()->find($partId->getValue());
        if ($partModel === null) {
            return null;
        }
        return $this->converter->convertModelToDomain($partModel);
    }

    public function getBySlug(PartSlug $partSlug): ?Part
    {
        /** @var PartModel $partModel */
        $partModel = $this->getQuery()->where('slug', $partSlug->getValue())->first();
        if ($partModel === null) {
            return null;
        }
        return $this->converter->convertModelToDomain($partModel);
    }

    /**
     * @return Part[]
     */
    public function search(string $searchText): array
    {
        /** @var PartModel[] $partModels */
        $partModels = $this->getQuery()->where('slug', 'LIKE', '%' . $searchText . '%')->limit(30)->get();
        return $this->converter->convertModelsToDomains($partModels);
    }

    public function all(int $offset, int $limit): array
    {
        /** @var PartModel[] $partModels */
        $partModels = $this->getQuery()->offset($offset)->limit($limit)->get();
        return $this->converter->convertModelsToDomains($partModels);
    }

    public function allCount(): int
    {
        return $this->getQuery()->count();
    }

    public function create(PartCreate $partCreate): Part
    {
        /** @var PartModel $partModel */
        $partModel = $this->getQuery()->create([
            'slug' => $partCreate->getSlug()->getValue(),
        ]);

        return $this->converter->convertModelToDomain($partModel);
    }

    public function update(PartUpdate $partUpdate): Part
    {
        throw new RuntimeException('Todo method EloquentPartRepository.update');
    }


    private function getQuery(): Builder
    {
        return $this->partModel->newQuery();
    }
}