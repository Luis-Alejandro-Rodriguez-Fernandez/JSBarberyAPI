<?php

namespace App\Repositories\Reservations;

use App\Models\Reservations\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ReservationRepository
{

    public function find(?int $id): Reservation|Model|null
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
            ->join('services as s', 's.id', '=', 'reservations.id_service')
            ->leftJoin('users as u', 'u.id', '=', 'reservations.id_user')
            ->selectRaw('COALESCE(u.name, reservations.name) as name')
            ->selectRaw('COALESCE(u.last_name, reservations.last_name) as last_name')
            ->selectRaw('COALESCE(reservations.id_user, NULL) as id_user')
            ->selectRaw('s.name as service_name')
            ->selectRaw('COALESCE(u.phone, reservations.phone) as phone')
            ->selectRaw('COALESCE(u.email, reservations.email) as email')
            ->selectRaw('reservations.appointment as appointment')
            ->selectRaw('reservations.confirmation as confirmation')
            ->selectRaw('reservations.canceled as canceled')
            ->selectRaw('reservations.hash as hash')
            ->selectRaw('reservations.id as id')
            ->selectRaw('COALESCE(reservations.price, s.price) as price')
            ->whereDate('reservations.appointment', '>=', Carbon::now()->toDateString())
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
            ->selectRaw('id_service')
            ->where('id_user', '=', $user->getId())
            ->whereDate('appointment', '>=', Carbon::now()->toDateString())
            ->with(['getServiceRelation'])
            ->get();
    }
}
