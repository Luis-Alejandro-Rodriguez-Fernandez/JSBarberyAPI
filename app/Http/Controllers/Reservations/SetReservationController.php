<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Models\Services\Services;
use App\Models\User;
use App\Repositories\Reservations\ReservationRepository;
use App\Repositories\Service\ServiceRepository;
use App\Services\Reservetions\ReservationCreator;
use App\ValueObjects\Reservations\UserReservationsItem;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class SetReservationController extends Controller
{
    public function __construct(
        private ServiceRepository $serviceRepository,
        private ReservationCreator $creator,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            if (!auth()->check()) {
                throw new Exception("Acceso Denegado");
            }

            $serviceId = $request->input('service_id');
            $date = $request->input('date');
            $time = $request->input('time');

            /** @var User $user */
            $user = auth()->user();

            if (is_null($serviceId)) {
                throw new Exception("Servicio desconocido");
            }

            if (empty($date) || empty($time)) {
                throw new Exception("Debe seleccionar fecha y hora para la cita");
            }

            /** @var Services $service */
            $service = $this->serviceRepository->find($serviceId);

            if (is_null($service)) {
                throw new Exception("El servicio solicitado no se encuentra disponile");
            }

            $datetime = strtotime(sprintf("%s%s", $date, $time));

            if (!$datetime) {
                throw new Exception("El formato de la fecha no es válidado");
            }

            $reservation = $this->creator->createFromUser(
                $user,
                $service,
                date('Y-m-d H:i:s', $datetime),
            );

            return $this->generalMethods()->responseToApp(1, UserReservationsItem::create($reservation)->toArray());
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
