<?php

namespace App\Services\Catalog;

use App\Http\Resources\Catalog\CatDayResource;
use App\Repositories\Catalog\CatDayRepository;
use App\Models\Catalog\CatDay;

class CatDayService
{
    protected $catDayRepository;

    public function __construct(CatDayRepository $catDayRepository)
    {
        $this->catDayRepository = $catDayRepository;
    }

    public function all()
    {
        $catDay = $this->catDayRepository->all();
        return CatDayResource::collection($catDay);
    }

    public function create(array $data): CatDayResource
    {
        $catDay = $this->catDayRepository->create($data);
        return new CatDayResource($catDay);
    }

    public function find(CatDay $catDay): CatDayResource
    {
        $catDay = $this->catDayRepository->find($catDay->id);
        return new CatDayResource($catDay);
    }

    public function update(CatDay $catDay, array $data): CatDayResource
    {
        $catDay = $this->catDayRepository->update($catDay, $data);
        return new CatDayResource($catDay);
    }

    public function delete(CatDay $catDay): void
    {
        $this->catDayRepository->delete($catDay);
    }
}
