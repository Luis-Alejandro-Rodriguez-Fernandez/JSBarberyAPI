<?php


namespace App\ValueObjects\Reservations;


use App\Models\Reservations\Reservation;
use App\Models\Services\Services;

class ReresvationsItem
{
    public function __construct(
        private int $id,
        private ?int $userId,
        private string $user,
        private string $hash,
        private ?string $phone,
        private string $email,
        private string $appointment,
        private string $service,
        private float $price,
        private bool $confirmation,
        private bool $canceled,
    )
    {
    }

    public static function create(Reservation $item): self
    {
        return new self(
            $item->getId(),
            $item->getUserId(),
            $item->getFullName(),
            $item->getHash(),
            $item->getPhone(),
            $item->getEmail(),
            $item->getAppointment(),
            $item->getServiceName(),
            $item->getPrice(),
            $item->isConfirmed(),
            $item->isCanceled(),
        );
    }

    public static function collect(iterable $elements): array
    {
        $items = [];

        foreach ($elements as $element) {
            $items[] = self::create($element)->toArray();
        }

        return $items;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'service' => $this->service ?? " -- ",
            'user_id' => $this->userId,
            'user' => $this->user,
            'hash' => $this->hash,
            'phone' => $this->phone,
            'email' => $this->email,
            'price' => $this->price,
            'appointment' => $this->appointment,
            'confirmation' => $this->confirmation ? 1 : 0,
            'canceled' => $this->canceled ? 1 : 0,
        ];
    }
}
