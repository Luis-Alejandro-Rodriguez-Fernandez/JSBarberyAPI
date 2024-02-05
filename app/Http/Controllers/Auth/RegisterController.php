<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {

        try {
            DB::beginTransaction();
            $messages = $this->authMethods()->validateRegistroFrom($request);

            if (!empty($messages)) {
                return $this->generalMethods()->responseToApp(0, null, $messages[0]);
            }

            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            DB::commit();

            $data =  [
                'token' => null,
                'user' => $user
            ];

            return $this->generalMethods()->responseToApp(1, $data, 'Registro completado correctamente');
        }catch (\Exception $e) {
            DB::rollBack();

            return $this->generalMethods()->responseToApp(0, null, $e->getMessage()[0]);
        }
    }
}
