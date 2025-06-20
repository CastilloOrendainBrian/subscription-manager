<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\Currency\StoreCatCurrencyRequest;
use App\Http\Requests\Catalog\Currency\UpdateCatCurrencyRequest;
use App\Services\Catalog\CatCurrencyService;
use App\Models\Catalog\CatCurrency;

use Illuminate\Http\Response;

class CatCurrencyController extends Controller
{
    protected $catCurrencyService;

    public function __construct(CatCurrencyService $catCurrencyService)
    {
        $this->catCurrencyService = $catCurrencyService;
    }

    public function index()
    {
        return $this->catCurrencyService->all();
    }

    public function store(StoreCatCurrencyRequest $request)
    {
        return $this->catCurrencyService->create($request->validated());
    }

    public function show(CatCurrency $catCurrency)
    {
        return $this->catCurrencyService->find($catCurrency);
    }

    public function update(UpdateCatCurrencyRequest $request, CatCurrency $catCurrency)
    {
        return $this->catCurrencyService->update($catCurrency, $request->validated());
    }

    public function destroy(CatCurrency $catCurrency)
    {
        $this->catCurrencyService->delete($catCurrency);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
