<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\WeekMonth\StoreCatWeekMonthRequest;
use App\Http\Requests\Catalog\WeekMonth\UpdateCatWeekMonthRequest;
use App\Services\Catalog\CatWeekMonthService;
use App\Models\Catalog\CatWeekMonth;

use Illuminate\Http\Response;

class CatWeekMonthController extends Controller
{
    protected $catWeekMonthService;

    public function __construct(CatWeekMonthService $catWeekMonthService)
    {
        $this->catWeekMonthService = $catWeekMonthService;
    }

    public function index()
    {
        return $this->catWeekMonthService->all();
    }

    public function store(StoreCatWeekMonthRequest $request)
    {
        return $this->catWeekMonthService->create($request->validated());
    }

    public function show(CatWeekMonth $catWeekMonth)
    {
        return $this->catWeekMonthService->find($catWeekMonth);
    }

    public function update(UpdateCatWeekMonthRequest $request, CatWeekMonth $catWeekMonth)
    {
        return $this->catWeekMonthService->update($catWeekMonth, $request->validated());
    }

    public function destroy(CatWeekMonth $catWeekMonth)
    {
        $this->catWeekMonthService->delete($catWeekMonth);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
