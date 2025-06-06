<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\TimeUnit\StoreCatTimeUnitRequest;
use App\Http\Requests\Catalog\TimeUnit\UpdateCatTimeUnitRequest;
use App\Http\Resources\Catalog\CatTimeUnitResource;
use App\Models\Catalog\CatTimeUnit;

use Illuminate\Http\Response;

class CatTimeUnitController extends Controller
{
    public function index()
    {
        $catTimeUnit = CatTimeUnit::all();
        return CatTimeUnitResource::collection($catTimeUnit);
    }

    public function store(StoreCatTimeUnitRequest $request)
    {
        $catTimeUnit = CatTimeUnit::create([
            'name' => $request->name,
            'acronym' => $request->acronym,
            'active' => true,
        ]);

        return new CatTimeUnitResource($catTimeUnit);
    }

    public function show(CatTimeUnit $catTimeUnit)
    {
        return new CatTimeUnitResource($catTimeUnit);
    }

    public function update(UpdateCatTimeUnitRequest $request, CatTimeUnit $catTimeUnit)
    {
        $catTimeUnit->update($request->validated());
        return new CatTimeUnitResource($catTimeUnit);
    }

    public function destroy(CatTimeUnit $catTimeUnit)
    {
        $catTimeUnit->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
