<?php

namespace App\Services\Catalog;

use App\Http\Resources\Catalog\CatTimeUnitResource;
use App\Repositories\Catalog\CatTimeUnitRepository;
use App\Models\Catalog\CatTimeUnit;

class CatTimeUnitService
{
    protected $catTimeUnitRepository;

    public function __construct(CatTimeUnitRepository $catTimeUnitRepository)
    {
        $this->catTimeUnitRepository = $catTimeUnitRepository;
    }

    public function all()
    {
        $catTimeUnit = $this->catTimeUnitRepository->all();
        return CatTimeUnitResource::collection($catTimeUnit);
    }

    public function create(array $data): CatTimeUnitResource
    {
        $catTimeUnit = $this->catTimeUnitRepository->create($data);
        return new CatTimeUnitResource($catTimeUnit);
    }

    public function find(CatTimeUnit $catTimeUnit): CatTimeUnitResource
    {
        $catTimeUnit = $this->catTimeUnitRepository->find($catTimeUnit->id);
        return new CatTimeUnitResource($catTimeUnit);
    }

    public function update(CatTimeUnit $catTimeUnit, array $data): CatTimeUnitResource
    {
        $catTimeUnit = $this->catTimeUnitRepository->update($catTimeUnit, $data);
        return new CatTimeUnitResource($catTimeUnit);
    }

    public function delete(CatTimeUnit $catTimeUnit): void
    {
        $this->catTimeUnitRepository->delete($catTimeUnit);
    }
}
