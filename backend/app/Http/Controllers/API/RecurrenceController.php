<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recurrence\StoreRecurrenceRequest;
use App\Http\Requests\Recurrence\UpdateRecurrenceRequest;
use App\Http\Resources\RecurrenceResource;
use App\Models\Recurrence;

use Illuminate\Http\Response;

class RecurrenceController extends Controller
{
    public function index()
    {
        $recurrence = Recurrence::all();
        return RecurrenceResource::collection($recurrence);
    }

    public function store(StoreRecurrenceRequest $request)
    {
        $recurrence = Recurrence::create($request->validated());
        return new RecurrenceResource($recurrence);
    }

    public function show(Recurrence $recurrence)
    {
        return new RecurrenceResource($recurrence);
    }

    public function update(UpdateRecurrenceRequest $request, Recurrence $recurrence)
    {
        $recurrence->update($request->validated());
        return new RecurrenceResource($recurrence);
    }

    public function destroy(Recurrence $recurrence)
    {
        $recurrence->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
