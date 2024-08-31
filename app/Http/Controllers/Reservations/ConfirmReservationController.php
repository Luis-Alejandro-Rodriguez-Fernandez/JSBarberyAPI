<?php


namespace App\Http\Controllers\Reservations;


use App\Http\Controllers\Controller;
use App\Models\Reservations\Reservation;
use App\Repositories\Reservations\ReservationRepository;
use App\ValueObjects\Reservations\UserReservationsItem;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ConfirmReservationController extends Controller
{
    public function __construct(
        private ReservationRepository $repository
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {

            $id = $request->id;

            if (empty($id)) {
                throw new Exception("No se pudo realizar la acción");
            }

            /** @var null|Reservation $reservation */
            $reservation = $this->repository->find($id);

            if (is_null($reservation)) {
                throw new Exception("No se pudo realizar la acción");
            }

            $reservation->confirm();

            return $this->generalMethods()->responseToApp(
                1,
                UserReservationsItem::create($reservation),
                "Reserva confirmada",
            );
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
