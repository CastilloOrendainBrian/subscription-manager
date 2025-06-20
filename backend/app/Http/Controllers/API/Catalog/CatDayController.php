<?php

namespace App\Http\Controllers\API\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\Day\StoreCatDayRequest;
use App\Http\Requests\Catalog\Day\UpdateCatDayRequest;
use App\Services\Catalog\CatDayService;
use App\Models\Catalog\CatDay;

use Illuminate\Http\Response;

class CatDayController extends Controller
{
    protected $catDayService;

    public function __construct(CatDayService $catDayService)
    {
        $this->catDayService = $catDayService;
    }

    public function index()
    {
        return $this->catDayService->all();
    }

    public function store(StoreCatDayRequest $request)
    {
        return $this->catDayService->create($request->validated());
    }

    public function show(CatDay $catDay)
    {
        return $this->catDayService->find($catDay);
    }

    public function update(UpdateCatDayRequest $request, CatDay $catDay)
    {
        return $this->catDayService->update($catDay, $request->validated());
    }

    public function destroy(CatDay $catDay)
    {
        $this->catDayService->delete($catDay);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
