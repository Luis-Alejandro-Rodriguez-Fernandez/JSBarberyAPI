<?php


namespace App\Http\Controllers\Auth;


use App\ValueObjects\Auth\LogoutObject;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    public function logout(): JsonResponse
    {
        try {
            $logoutObject = new LogoutObject();

            $user = $logoutObject->getUser();

            if (is_null($user)) {
                return $this->generalMethods()->responseToApp(0, null, 'Error al cerrar la sesión');
            }

            $user->currentAccessToken()->delete();

            return $this->generalMethods()->responseToApp(1, null, 'Sesión cerrada correctamente');
        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
