<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = "admin_config";

    protected $fillable = [
        'phone',
        'email',
        'first_journal',
        'second_journal',
        'disabled_days',
        'instagram',
        'tiktok',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstJournalStart(): ?string
    {
        return (!is_null($this->first_journal) ? explode("-", $this->first_journal)[0] : null) ?? null;
    }

    public function getFirstJournalEnd(): ?string
    {
        return (!is_null($this->first_journal) ? explode("-", $this->first_journal)[1] : null) ?? null;
    }

    public function getSecondJournalStart(): ?string
    {
        return (!is_null($this->second_journal) ? explode("-", $this->second_journal)[0] : null) ?? null;
    }

    public function getSecondJournalEnd(): ?string
    {
        return (!is_null($this->second_journal) ? explode("-", $this->second_journal)[1] : null) ?? null;
    }

    public function getDisabledDays(): ?array
    {
        return $this->disabled_days;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function getTiktok(): ?string
    {
        return $this->tiktok;
    }

}
