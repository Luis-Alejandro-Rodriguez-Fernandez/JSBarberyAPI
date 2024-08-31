<?php


namespace App\Services\Reservetions;


use App\Models\Reservations\Reservation;
use Exception;

class ReservationUpdater
{
    public function update(
        Reservation $reservation,
        string $newAppointment
    ): Reservation
    {
        $reservation->setNewAppointment($newAppointment);

        if (!$reservation->save()) {
            throw new Exception("Hubo un error al realizar la petición. Por favor, intentelo más tarde");
        }

        return $reservation;
    }
}
