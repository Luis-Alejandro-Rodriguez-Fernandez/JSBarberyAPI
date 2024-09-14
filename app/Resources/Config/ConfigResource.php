<?php

namespace App\Resources\Config;

use App\Models\Config\Config;
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
        /** @var Config $this */
        return [
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'first_journal_start' => $this->getFirstJournalStart(),
            'first_journal_end' => $this->getFirstJournalEnd(),
            'second_journal_start' => $this->getSecondJournalStart(),
            'second_journal_end' => $this->getSecondJournalEnd(),
            'disabled_days' => $this->getDisabledDays(),
            'instagram' => $this->getInstagram(),
            'tiktok' => $this->getTiktok(),
        ];
    }
}
