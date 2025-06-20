<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\Month\StoreCatMonthRequest;
use App\Http\Requests\Catalog\Month\UpdateCatMonthRequest;
use App\Services\Catalog\CatMonthService;
use App\Models\Catalog\CatMonth;

use Illuminate\Http\Response;

class CatMonthController extends Controller
{
    protected $catMonthService;

    public function __construct(CatMonthService $catMonthService)
    {
        $this->catMonthService = $catMonthService;
    }

    public function index()
    {
        return $this->catMonthService->all();
    }

    public function store(StoreCatMonthRequest $request)
    {
        return $this->catMonthService->create($request->validated());
    }

    public function show(CatMonth $catMonth)
    {
        return $this->catMonthService->find($catMonth);
    }

    public function update(UpdateCatMonthRequest $request, CatMonth $catMonth)
    {
        return $this->catMonthService->update($catMonth, $request->validated());
    }

    public function destroy(CatMonth $catMonth)
    {
        $this->catMonthService->delete($catMonth);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
