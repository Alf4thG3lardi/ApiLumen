<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register( Request $request)
    {
        // echo "register";
        $data = [
            "email" => $request->input("email"),
            "password" => $request->input("password"),
            "level" => "pelanggann",
            "api_token" => "1234560",
            "status" => "1",
            "relasi" => $request->input("email"),
        ];
        User::create($data);
        return response()->json($data);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where("email", $email)->first();

        if ($user->password === $password) {
            $token = Str::random(40);

            $user->update([
                'api_token' => $token,
            ]);

            return response()->json([
                'pesan' => "login berhasil",
                'token' => $token,
                'data' => $user,
            ]);
        }
    }
}
