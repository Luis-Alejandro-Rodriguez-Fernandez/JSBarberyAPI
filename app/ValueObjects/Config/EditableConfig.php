<?php

namespace App\ValueObjects\Config;

use Exception;
use Symfony\Component\HttpFoundation\Request;

class EditableConfig
{
    /**
     * @throws Exception
     */
    public function __construct(
        private readonly ?string $email,
        private readonly ?string $phone,
        private readonly ?string $firstJournalStart,
        private readonly ?string $firstJournalEnd,
        private readonly ?string $secondJournalStart,
        private readonly ?string $secondJournalEnd,
        private readonly ?array $disabledDays,
        private readonly ?string $instagram,
        private readonly ?string $tiktok,
    )
    {
        $this->validate();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getFirstJournal(): ?string
    {
        return !is_null($this->firstJournalStart)
            ? sprintf("%s-%s", $this->firstJournalStart, $this->firstJournalEnd)
            : null;
    }

    public function getSecondJournal(): ?string
    {
        return !is_null($this->secondJournalStart)
            ? sprintf("%s-%s", $this->secondJournalStart, $this->secondJournalEnd)
            : null;
    }

    public function getDisabledDays(): ?array
    {
        return $this->disabledDays;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function getTiktok(): ?string
    {
        return $this->tiktok;
    }

    /**
     * @throws Exception
     */
    public static function create(Request $request): self
    {
        return new self(
            $request->email,
            $request->phone,
            $request->first_journal_start,
            $request->first_journal_end,
            $request->second_journal_start,
            $request->second_journal_end,
            $request->disabled_days,
            $request->instagram,
            $request->tiktok,
        );
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El email introducido no tiene un formato válido");
        }

        if (!is_null($this->firstJournalStart) && is_null($this->firstJournalEnd)) {
            throw new Exception("Es necesario indicar el final del primer turno");
        }

        if (!is_null($this->secondJournalStart) && is_null($this->secondJournalEnd)) {
            throw new Exception("Es necesario indicar el final del segundo turno");
        }
    }
}
