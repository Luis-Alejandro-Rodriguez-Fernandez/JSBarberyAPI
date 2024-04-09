<?php

namespace App\Resources\Service;

use App\Resources\Department\DepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'id_department' => $this->getIdDepartment(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'duration' => $this->getDuration(),
            'duration_string' => $this->getDurationString(),
            'price' => $this->getPrice(),
            'active' => $this->isActive(),
            'department' => $this->whenLoaded('department', function () {
                return !empty($this->department) ? new DepartmentResource($this->department) : null;
            }) ?? null,
        ];
    }
}
