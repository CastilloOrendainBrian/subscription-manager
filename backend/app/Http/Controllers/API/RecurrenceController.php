<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recurrence\StoreRecurrenceRequest;
use App\Http\Requests\Recurrence\UpdateRecurrenceRequest;
use App\Services\RecurrenceService;
use App\Models\Recurrence;

use Illuminate\Http\Response;

class RecurrenceController extends Controller
{
    protected $recurrenceService;

    public function __construct(RecurrenceService $recurrenceService)
    {
        $this->recurrenceService = $recurrenceService;
    }

    public function index()
    {
        return $this->recurrenceService->all();
    }

    public function store(StoreRecurrenceRequest $request)
    {
        return $this->recurrenceService->create($request->validated());
    }

    public function show(Recurrence $recurrence)
    {
        return $this->recurrenceService->find($recurrence);
    }

    public function update(UpdateRecurrenceRequest $request, Recurrence $recurrence)
    {
        return $this->recurrenceService->update($recurrence, $request->validated());
    }

    public function destroy(Recurrence $recurrence)
    {
        $this->recurrenceService->delete($recurrence);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
