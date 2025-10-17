<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollaborationResource extends JsonResource
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
            'city' => optional($this->city)->name,
            'company' => optional($this->company)->name,
            'collaborator' => optional($this->collaborator)->name,
            'date' => optional($this->collaboration_date)->format('Y-m-d'),
            'status' => $this->status,
        ];
    }
}
