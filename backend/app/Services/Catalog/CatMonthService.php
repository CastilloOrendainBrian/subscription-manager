<?php

namespace App\Services\Catalog;

use App\Http\Resources\Catalog\CatMonthResource;
use App\Repositories\Catalog\CatMonthRepository;
use App\Models\Catalog\CatMonth;

class CatMonthService
{
    protected $catMonthRepository;

    public function __construct(CatMonthRepository $catMonthRepository)
    {
        $this->catMonthRepository = $catMonthRepository;
    }

    public function all()
    {
        $catMonth = $this->catMonthRepository->all();
        return CatMonthResource::collection($catMonth);
    }

    public function create(array $data): CatMonthResource
    {
        $catMonth = $this->catMonthRepository->create($data);
        return new CatMonthResource($catMonth);
    }

    public function find(CatMonth $catMonth): CatMonthResource
    {
        $catMonth = $this->catMonthRepository->find($catMonth->id);
        return new CatMonthResource($catMonth);
    }

    public function update(CatMonth $catMonth, array $data): CatMonthResource
    {
        $catMonth = $this->catMonthRepository->update($catMonth, $data);
        return new CatMonthResource($catMonth);
    }

    public function delete(CatMonth $catMonth): void
    {
        $this->catMonthRepository->delete($catMonth);
    }
}
