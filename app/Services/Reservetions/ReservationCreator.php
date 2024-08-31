<?php

namespace App\Services\Reservetions;

use App\Models\Reservations\Reservation;
use App\Models\Services\Services;
use App\Models\User;

class ReservationCreator
{

    public function create(
        Services $service,
        string $name,
        string $lastName,
        ?string $phone,
        string $email,
        string $appointment,
    ): Reservation
    {
        return Reservation::create(
            null,
            serviceId: $service->getId(),
            name: $name,
            lastName: $lastName,
            phone: $phone,
            email: $email,
            appointment: $appointment,
            price: $service->getPriceRaw(),
        );
    }

    public function createFromUser(
        User $user,
        Services $service,
        string $appointment,
    ): Reservation
    {
        return Reservation::create(
            $user->getId(),
            $service->getId(),
            $user->getName(),
            $user->getLastName(),
            $user->getPhone(),
            $user->getEmail(),
            $appointment,
            $service->getPriceRaw(),
        );
    }
}
