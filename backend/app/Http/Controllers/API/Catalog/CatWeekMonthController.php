<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\WeekMonth\StoreCatWeekMonthRequest;
use App\Http\Requests\Catalog\WeekMonth\UpdateCatWeekMonthRequest;
use App\Http\Resources\Catalog\CatWeekMonthResource;
use App\Models\Catalog\CatWeekMonth;

use Illuminate\Http\Response;

class CatWeekMonthController extends Controller
{
    public function index()
    {
        $catWeekMonth = CatWeekMonth::all();
        return CatWeekMonthResource::collection($catWeekMonth);
    }

    public function store(StoreCatWeekMonthRequest $request)
    {
        $catWeekMonth = CatWeekMonth::create($request->validated());

        return new CatWeekMonthResource($catWeekMonth);
    }

    public function show(CatWeekMonth $catWeekMonth)
    {
        return new CatWeekMonthResource($catWeekMonth);
    }

    public function update(UpdateCatWeekMonthRequest $request, CatWeekMonth $catWeekMonth)
    {
        $catWeekMonth->update($request->validated());
        return new CatWeekMonthResource($catWeekMonth);
    }

    public function destroy(CatWeekMonth $catWeekMonth)
    {
        $catWeekMonth->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
