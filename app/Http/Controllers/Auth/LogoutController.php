<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return $this->generalMethods()->responseToApp(0, null, 'Error al cerrar la sesión');
        }

        $user->currentAccessToken()->delete();


        return $this->generalMethods()->responseToApp(1, null, 'Sesión cerrada correctamente');
    }
}
