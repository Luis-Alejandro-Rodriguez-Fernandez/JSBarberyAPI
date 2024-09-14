<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Models\Services\Services;
use App\Repositories\Reservations\ReservationRepository;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Users\UsersRepository;
use App\Services\Reservetions\ReservationCreator;
use App\ValueObjects\Reservations\UserReservationsItem;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class SetUnauthenticatedReservationController extends Controller
{
    public function __construct(
        private ServiceRepository $serviceRepository,
        private UsersRepository $usersRepository,
        private ReservationCreator $creator,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $service = null;
            $serviceId = $request->input('service_id');
            $name = $request->input('name');
            $lastName = $request->input('last_name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $date = $request->input('date');
            $time = $request->input('time');

            if (empty($name) || empty($lastName)) {
                throw new Exception("El nombre y apellido son campos obligatorios");
            }

            if (empty($email)) {
                throw new Exception("El email es un campo obligatorio");
            }

            if (!is_null($this->usersRepository->findByEmail($email))) {
                return $this->generalMethods()->responseToApp(2, null, "Ya tienes una cuenta con este email");
            }

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

            $reservation = $this->creator->create(
                $service,
                $name,
                $lastName,
                $phone,
                $email,
                date('Y-m-d H:i:s', $datetime),
            );

            return $this->generalMethods()->responseToApp(1, $reservation);
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
