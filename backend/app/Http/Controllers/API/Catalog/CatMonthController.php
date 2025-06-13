<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\Month\StoreCatMonthRequest;
use App\Http\Requests\Catalog\Month\UpdateCatMonthRequest;
use App\Http\Resources\Catalog\CatMonthResource;
use App\Models\Catalog\CatMonth;

use Illuminate\Http\Response;

class CatMonthController extends Controller
{
    public function index()
    {
        $catMonth = CatMonth::all();
        return CatMonthResource::collection($catMonth);
    }

    public function store(StoreCatMonthRequest $request)
    {
        $catMonth = CatMonth::create($request->validated());

        return new CatMonthResource($catMonth);
    }

    public function show(CatMonth $catMonth)
    {
        return new CatMonthResource($catMonth);
    }

    public function update(UpdateCatMonthRequest $request, CatMonth $catMonth)
    {
        $catMonth->update($request->validated());
        return new CatMonthResource($catMonth);
    }

    public function destroy(CatMonth $catMonth)
    {
        $catMonth->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
