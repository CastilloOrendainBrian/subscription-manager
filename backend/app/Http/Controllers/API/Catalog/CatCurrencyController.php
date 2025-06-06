<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\Currency\StoreCatCurrencyRequest;
use App\Http\Requests\Catalog\Currency\UpdateCatCurrencyRequest;
use App\Http\Resources\Catalog\CatCurrencyResource;
use App\Models\Catalog\CatCurrency;

use Illuminate\Http\Response;

class CatCurrencyController extends Controller
{
    public function index()
    {
        $catCurrency = CatCurrency::all();
        return CatCurrencyResource::collection($catCurrency);
    }

    public function store(StoreCatCurrencyRequest $request)
    {
        $catCurrency = CatCurrency::create([
            'name' => $request->name,
            'acronym' => $request->acronym,
            'active' => true,
        ]);

        return new CatCurrencyResource($catCurrency);
    }

    public function show(CatCurrency $catCurrency)
    {
        return new CatCurrencyResource($catCurrency);
    }

    public function update(UpdateCatCurrencyRequest $request, CatCurrency $catCurrency)
    {
        $catCurrency->update($request->validated());
        return new CatCurrencyResource($catCurrency);
    }

    public function destroy(CatCurrency $catCurrency)
    {
        $catCurrency->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
