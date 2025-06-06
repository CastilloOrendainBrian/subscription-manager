<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\Day\StoreCatDayRequest;
use App\Http\Requests\Catalog\Day\UpdateCatDayRequest;
use App\Http\Resources\Catalog\CatDayResource;
use App\Models\Catalog\CatDay;

use Illuminate\Http\Response;

class CatDayController extends Controller
{
    public function index()
    {
        $catDay = CatDay::all();
        return CatDayResource::collection($catDay);
    }

    public function store(StoreCatDayRequest $request)
    {
        $catDay = CatDay::create([
            'name' => $request->name,
            'acronym' => $request->acronym,
            'active' => true,
        ]);

        return new CatDayResource($catDay);
    }

    public function show(CatDay $catDay)
    {
        return new CatDayResource($catDay);
    }

    public function update(UpdateCatDayRequest $request, CatDay $catDay)
    {
        $catDay->update($request->validated());
        return new CatDayResource($catDay);
    }

    public function destroy(CatDay $catDay)
    {
        $catDay->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
