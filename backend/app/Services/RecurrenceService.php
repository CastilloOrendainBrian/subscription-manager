<?php

namespace App\Services;

use App\Http\Resources\RecurrenceResource;
use App\Repositories\RecurrenceRepository;
use App\Models\Recurrence;

class RecurrenceService
{
    protected $recurrenceRepository;

    public function __construct(RecurrenceRepository $recurrenceRepository)
    {
        $this->recurrenceRepository = $recurrenceRepository;
    }

    public function all()
    {
        $recurrences = $this->recurrenceRepository->all();
        return RecurrenceResource::collection($recurrences);
    }

    public function create(array $data): RecurrenceResource
    {
        $recurrence = $this->recurrenceRepository->create($data);
        return new RecurrenceResource($recurrence);
    }

    public function find(Recurrence $recurrence): RecurrenceResource
    {
        $recurrence = $this->recurrenceRepository->find($recurrence->id);
        return new RecurrenceResource($recurrence);
    }

    public function update(Recurrence $recurrence, array $data): RecurrenceResource
    {
        $recurrence = $this->recurrenceRepository->update($recurrence, $data);
        return new RecurrenceResource($recurrence);
    }

    public function delete(Recurrence $recurrence): void
    {
        $this->recurrenceRepository->delete($recurrence);
    }
}
