<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Repositories\Reservations\ReservationRepository;
use App\Repositories\Users\UsersRepository;
use App\ValueObjects\Reservations\UserReservationsItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUserReservationsController extends Controller
{
    public function __construct(
        private UsersRepository       $usersRepository,
        private ReservationRepository $reservationRepository,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $userId = $request->user_id;

            $user = $this->usersRepository->find($userId);

            if (is_null($user)) {
                throw new Exception("No se ha encontado el usuario indicado.");
            }

            $reservartions = $this->reservationRepository->getListByUser($user);

            return $this->generalMethods()->responseToApp(1, UserReservationsItem::collect($reservartions));

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
