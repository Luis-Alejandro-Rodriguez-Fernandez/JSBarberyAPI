<?php


namespace App\Http\Controllers\Auth;


use App\ValueObjects\Auth\LoginObject;
use App\Http\Controllers\Controller;
use App\Resources\Auth\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {

            $loginObject = new LoginObject($request);

            $login = Auth::attempt([
                'email' => $loginObject->getEmail(),
                'password' => $loginObject->getPassword()
            ]);

            if (!$login) {
                throw new Exception('El email o la contraseña son incorrectos');
            }

            $user = Auth::user();

            if (!$user) {
                return $this->generalMethods()->responseToApp(0, null, 'El usuario o la conraseña no son correctos');
            }

            return $this->generalMethods()->responseToApp(1, new UserResource($user), 'Sesión iniciada correctamente');

        } catch (Exception $exception) {
            return $this->generalMethods()->responseToApp(0, null, $exception->getMessage());
        }
    }
}
