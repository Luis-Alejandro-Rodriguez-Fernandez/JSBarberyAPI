<?php


namespace App\Http\Controllers\Reservations;


use App\Http\Controllers\Controller;
use App\Repositories\Reservations\ReservationRepository;
use Exception;
use Illuminate\Http\Client\Request;

class DeleteReservationController extends Controller
{
    public function __construct(
        private ReservationRepository $repository,
    )
    {
    }

    public function __invoke(Request $request)
    {
        try {

            $id = $request->id;

            $reservation = $this->repository->find($id);

            if (is_null($reservation)) {
                throw new Exception("No se encontró la reserva indicada");
            }

            $deleted = $this->repository->delete($reservation);

            if (!$deleted) {
                throw new Exception("No se pudo eliminar la reserva, intentelo más tarde");
            }

            $this->generalMethods()->responseToApp(1, null, "Reserva eliminada correctamente");

        } catch (Exception $exception) {
            $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
