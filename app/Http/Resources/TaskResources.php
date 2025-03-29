<?php

namespace App\Http\Resources;

use App\Services\CalendarServices\CalendarService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userName' => $this->userName,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'startDate' =>  CalendarService::formatter($this->start_date),
            'endDate' => CalendarService::formatter($this->end_date),
            'createdAt' => CalendarService::formatter($this->created_at),
        ];
    }
}
