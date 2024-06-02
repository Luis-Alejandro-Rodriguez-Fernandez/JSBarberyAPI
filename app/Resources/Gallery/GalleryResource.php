<?php

namespace App\Resources\Gallery;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'department_id' => $this->getDepartmentId(),
            'url' => $this->getUrl(),
            'date' => $this->getDate(),
            'active' => $this->getActive(),
        ];
    }
}
