<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\TimeUnit\StoreCatTimeUnitRequest;
use App\Http\Requests\Catalog\TimeUnit\UpdateCatTimeUnitRequest;
use App\Services\Catalog\CatTimeUnitService;
use App\Models\Catalog\CatTimeUnit;

use Illuminate\Http\Response;

class CatTimeUnitController extends Controller
{
    protected $catTimeUnitService;

    public function __construct(CatTimeUnitService $catTimeUnitService)
    {
        $this->catTimeUnitService = $catTimeUnitService;
    }

    public function index()
    {
        return $this->catTimeUnitService->all();
    }

    public function store(StoreCatTimeUnitRequest $request)
    {
        return $this->catTimeUnitService->create($request->validated());
    }

    public function show(CatTimeUnit $catTimeUnit)
    {
        return $this->catTimeUnitService->find($catTimeUnit);
    }

    public function update(UpdateCatTimeUnitRequest $request, CatTimeUnit $catTimeUnit)
    {
        return $this->catTimeUnitService->update($catTimeUnit, $request->validated());
    }

    public function destroy(CatTimeUnit $catTimeUnit)
    {
        $this->catTimeUnitService->delete($catTimeUnit);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
