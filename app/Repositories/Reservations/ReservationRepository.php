<?php

namespace App\Repositories\Reservations;

use App\Models\Reservations\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ReservationRepository
{

    public function find(int $id): Reservation|Model|null
    {
        return Reservation::query()->find($id);
    }

    /**
     * @return  iterable<Reservation>
     */
    public function getList(): iterable
    {
        return Reservation::query()
            ->withoutGlobalScopes()
            ->join('services as s', 's.id', '=', 'reservation.id_service')
            ->leftJoin('user as u', 'u.id', '=', 'reservation.id_user')
            ->selectRaw('COALECSE(u.name, reservation.name) as name')
            ->selectRaw('COALECSE(u.last_name, reservation.last_name) as last_name')
            ->selectRaw('s.name as service_name')
            ->selectRaw('COALECSE(u.phone, reservation.phone) as phone')
            ->selectRaw('COALECSE(u.email, reservation.email) as email')
            ->selectRaw('reservation.appointment as appointment')
            ->selectRaw('reservation.confirmation as confirmation')
            ->selectRaw('reservation.canceled as canceled')
            ->selectRaw('reservation.hash as hash')
            ->get();
    }

    public function delete(Reservation $reservation): bool
    {
        return $reservation->delete();
    }

    public function getListByUser(User $user): iterable
    {
        return Reservation::query()
            ->selectRaw('id')
            ->selectRaw('phone')
            ->selectRaw('hash')
            ->selectRaw('email')
            ->selectRaw('price')
            ->selectRaw('appointment')
            ->selectRaw('confirmation')
            ->selectRaw('canceled')
            ->where('id_user', '=', $user->getId())
            ->whereRaw('appointment < CURDATE()')
            ->with(['getServiceRelation'])
            ->get();
    }
}
