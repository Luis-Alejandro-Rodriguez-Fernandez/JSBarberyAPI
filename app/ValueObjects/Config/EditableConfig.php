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
        private readonly ?string $firstJournal,
        private readonly ?string $secondJournal,
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
        return $this->firstJournal;
    }

    public function getSecondJournal(): ?string
    {
        return $this->secondJournal;
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
            $request->first_journal,
            $request->second_journal,
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
    }
}
