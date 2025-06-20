<?php

namespace App\Services\Catalog;

use App\Http\Resources\Catalog\CatWeekMonthResource;
use App\Repositories\Catalog\CatWeekMonthRepository;
use App\Models\Catalog\CatWeekMonth;

class CatWeekMonthService
{
    protected $catWeekMonthRepository;

    public function __construct(CatWeekMonthRepository $catWeekMonthRepository)
    {
        $this->catWeekMonthRepository = $catWeekMonthRepository;
    }

    public function all()
    {
        $catWeekMonth = $this->catWeekMonthRepository->all();
        return CatWeekMonthResource::collection($catWeekMonth);
    }

    public function create(array $data): CatWeekMonthResource
    {
        $catWeekMonth = $this->catWeekMonthRepository->create($data);
        return new CatWeekMonthResource($catWeekMonth);
    }

    public function find(CatWeekMonth $catWeekMonth): CatWeekMonthResource
    {
        $catWeekMonth = $this->catWeekMonthRepository->find($catWeekMonth->id);
        return new CatWeekMonthResource($catWeekMonth);
    }

    public function update(CatWeekMonth $catWeekMonth, array $data): CatWeekMonthResource
    {
        $catWeekMonth = $this->catWeekMonthRepository->update($catWeekMonth, $data);
        return new CatWeekMonthResource($catWeekMonth);
    }

    public function delete(CatWeekMonth $catWeekMonth): void
    {
        $this->catWeekMonthRepository->delete($catWeekMonth);
    }
}
