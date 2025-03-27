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
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'start_date' =>  CalendarService::getPersianDate($this->start_date),
            'end_date' => CalendarService::getPersianDate($this->created_at),
            'created_at' => CalendarService::getPersianDate($this->created_at),
        ];
    }
}
