<?php

namespace App\Services\Catalog;

use App\Http\Resources\Catalog\CatCurrencyResource;
use App\Repositories\Catalog\CatCurrencyRepository;
use App\Models\Catalog\CatCurrency;

class CatCurrencyService
{
    protected $catCurrencyRepository;

    public function __construct(CatCurrencyRepository $catCurrencyRepository)
    {
        $this->catCurrencyRepository = $catCurrencyRepository;
    }

    public function all()
    {
        $catCurrency = $this->catCurrencyRepository->all();
        return CatCurrencyResource::collection($catCurrency);
    }

    public function create(array $data): CatCurrencyResource
    {
        $catCurrency = $this->catCurrencyRepository->create($data);
        return new CatCurrencyResource($catCurrency);
    }

    public function find(CatCurrency $catCurrency): CatCurrencyResource
    {
        $catCurrency = $this->catCurrencyRepository->find($catCurrency->id);
        return new CatCurrencyResource($catCurrency);
    }

    public function update(CatCurrency $catCurrency, array $data): CatCurrencyResource
    {
        $catCurrency = $this->catCurrencyRepository->update($catCurrency, $data);
        return new CatCurrencyResource($catCurrency);
    }

    public function delete(CatCurrency $catCurrency): void
    {
        $this->catCurrencyRepository->delete($catCurrency);
    }
}