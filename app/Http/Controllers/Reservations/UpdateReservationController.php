<?php


namespace App\Http\Controllers\Reservations;


use App\Http\Controllers\Controller;
use App\Repositories\Reservations\ReservationRepository;
use App\Services\Reservetions\ReservationUpdater;
use App\ValueObjects\Reservations\UserReservationsItem;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateReservationController extends Controller
{
    public function __construct(
        private ReservationRepository $repository,
        private ReservationUpdater $reservationUpdater,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $reservationId = $request->input('id');
            $date = $request->input('date');
            $time = $request->input('time');

            if (is_null($reservationId)) {
                throw new Exception("No se ha encontrado la reserva indicada");
            }

            if (empty($date) || empty($time)) {
                throw new Exception("Debe seleccionar fecha y hora para la cita");
            }

            $reservation = $this->repository->find($reservationId);

            if (is_null($reservation)) {
                throw new Exception("No se ha encontrado la reserva indicada");
            }

            $datetime = strtotime(sprintf("%s%s", $date, $time));

            if (!$datetime) {
                throw new Exception("El formato de la fecha no es válidado");
            }

            $reservation = $this->reservationUpdater->update();

            return $this->generalMethods()->responseToApp(1, UserReservationsItem::create($reservation));
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
