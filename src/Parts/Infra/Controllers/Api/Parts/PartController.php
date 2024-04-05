<?php

namespace Kurnosovmak\Parts\Parts\Infra\Controllers\Api\Parts;

use GetPartResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Kurnosovmak\Parts\Parts\Domain\Entities\PartCreate;
use Kurnosovmak\Parts\Parts\Domain\Exceptions\NotUniqException;
use Kurnosovmak\Parts\Parts\Domain\Services\PartService;
use Kurnosovmak\Parts\Parts\Domain\VO\PartId;
use Kurnosovmak\Parts\Parts\Domain\VO\PartSlug;
use Kurnosovmak\Parts\Parts\Infra\Controllers\Controller;
use Kurnosovmak\Parts\Parts\Infra\Exceptions\ErrorDataException;
use Kurnosovmak\Parts\Parts\Infra\Resources\Api\Parts\CreateResource;
use Kurnosovmak\Parts\Parts\Infra\Resources\Api\Parts\GetResource;
use Kurnosovmak\Parts\Parts\Infra\Resources\Api\Parts\SearchResource;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\CursorData;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part\CreateData;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part\GetPartByIdData;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part\GetPartBySlugData;
use Kurnosovmak\Parts\Parts\Infra\Vo\Api\Part\SearchData;
use NotFoundResource;

class PartController extends Controller
{
    public function __construct(private readonly PartService $partService)
    {
    }

    /**
     * @throws ErrorDataException
     */
    public function get(Request $request): JsonResource
    {
        $cursor = CursorData::create(
            $request->get('offset', 0),
            $request->get('limit', 20),
        );

        [$parts, $count] = $this->partService->get($cursor);

        return new GetResource($parts, $count);
    }

    /**
     * @throws ErrorDataException
     */
    public function getPartById(Request $request): JsonResource
    {
        $data = GetPartByIdData::create(
            partId: $request->route('part_id'),
        );

        $part = $this->partService->getById(new PartId($data->getPartId()));

        if ($part === null) {
            return new NotFoundResource();
        }

        return new GetPartResource($part);
    }

    /**
     * @throws ErrorDataException
     */
    public function getPartBySlug(Request $request): JsonResource
    {
        $data = GetPartBySlugData::create(
            partSlug: $request->route('part_slug'),
        );

        $part = $this->partService->getBySlug(new PartSlug($data->getPartSlug()));

        if ($part === null) {
            return new NotFoundResource();
        }

        return new GetPartResource($part);
    }

    /**
     * @throws ErrorDataException
     */
    public function search(Request $request): JsonResource
    {
        $data = SearchData::create(
            searchText: $request->get('text'),
        );

        $parts = $this->partService->search($data->getText());
        return new SearchResource($parts);
    }

    /**
     * @throws NotUniqException
     * @throws ErrorDataException
     */
    public function create(Request $request): JsonResource
    {
        $data = CreateData::create(
            slug: $request->get('part_slug'),
        );

        $part = $this->partService->create(new PartCreate(
            slug: new PartSlug($data->getSlug()),
        ));
        return new CreateResource($part);
    }
}