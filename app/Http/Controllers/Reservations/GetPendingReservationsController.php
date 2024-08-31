<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Repositories\Reservations\ReservationRepository;
use App\ValueObjects\Reservations\ReresvationsItem;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetPendingReservationsController extends Controller
{
    public function __construct(
        private ReservationRepository $repository,
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        try {

            $reservations = $this->repository->getList();

            return $this->generalMethods()->responseToApp(1, ReresvationsItem::collect($reservations));
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
