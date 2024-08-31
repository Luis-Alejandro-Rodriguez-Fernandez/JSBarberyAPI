<?php

namespace App\Resources\Config;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'disabled_days' => $this->getDisabledDays(),
            'instagram' => $this->getInstagram(),
            'tiktok' => $this->getTiktok(),
        ];
    }
}
