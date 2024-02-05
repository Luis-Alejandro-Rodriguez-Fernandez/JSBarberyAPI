<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $messages = $this->authMethods()->validateLoginForm($request);

        if (!empty($messages)) {
            return $this->generalMethods()->responseToApp(0, null, $messages[0]);
        }

        $user = Auth::user();

        if (!$user) {
            return $this->generalMethods()->responseToApp(0, null, 'El usuario o la conraseña no son correctos');
        }

        $data = [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];

        return $this->generalMethods()->responseToApp(1, $data, 'Sesión iniciada correctamente');
    }
}
