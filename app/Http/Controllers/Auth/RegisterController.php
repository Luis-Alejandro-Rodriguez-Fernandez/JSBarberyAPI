<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Resources\Auth\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entities\Auth\RegisterObject;
use App\Services\User\UsersService;

class RegisterController extends Controller
{
    protected UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $register = new RegisterObject($request,  $this->usersService);

            DB::beginTransaction();

            $user = $this->usersService->createUser($register);

            if (is_null($user)) {
                throw new Exception('Error al crear el usuario. Pongase en contacto con el servicio técnico o intentelo más tarde');
            }

            DB::commit();

            return $this->generalMethods()->responseToApp(1, new UserResource($user), 'Registro completado correctamente');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->generalMethods()->responseToApp(0, null, $e->getMessage());
        }
    }
}
