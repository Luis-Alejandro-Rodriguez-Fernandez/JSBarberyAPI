<?php


namespace App\ValueObjects\Reservations;


use App\Models\Reservations\Reservation;
use App\Models\Services\Services;

class UserReservationsItem
{

    public function __construct(
        private int $id,
        private string $hash,
        private ?string $phone,
        private string $email,
        private float $price,
        private string $appointment,
        private bool $confirmation,
        private bool $canceled,
        private ?Services $service,
    )
    {
    }

    public static function create(Reservation $item): self
    {
        return new self(
            $item->getId(),
            $item->getHash(),
            $item->getPhone(),
            $item->getEmail(),
            $item->getPrice(),
            $item->getAppointment(),
            $item->isConfirmed(),
            $item->isCanceled(),
            $item->getServiceRelation,
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
            'hash' => $this->hash,
            'service' => $this->service?->getName() ?? " -- ",
            'phone' => $this->phone,
            'email' => $this->email,
            'price' => $this->price,
            'appointment' => $this->appointment,
            'confirmation' => $this->confirmation ? 1 : 0,
            'canceled' => $this->canceled ? 1 : 0,
        ];
    }
}
