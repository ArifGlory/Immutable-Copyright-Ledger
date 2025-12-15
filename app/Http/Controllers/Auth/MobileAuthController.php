<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Google_Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class MobileAuthController extends Controller
{
    public function googleSignIn(Request $request){
        $idToken = $request->input('idToken');

        if (!$idToken) {
            return ResponseJson(null,false,"Id token dibutuhkan",400);
        }

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);

        try {
            $payload = $client->verifyIdToken($idToken);
            if (!$payload) {
                return ResponseJson(null,false,"Invalid ID Token ",401);
            }

            $googleId = $payload['sub'];
            $email = $payload['email'];
            $name = $payload['name'];

            $user = User::where('google_id', $googleId)->orWhere('email', $email)->first();

            if (!$user) {
                // Jika belum terdaftar, buat akun baru
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'google_id' => $googleId,
                    'password' => Hash::make(uniqid()),  // buat password random
                ]);
            }
            $user->user_id = encodeId($user->id);

            // Buat token akses menggunakan Sanctum
            $token = $user->createToken('auth_token')->plainTextToken;
            $data = array(
                'user' => $user,
                'token' => $token
            );

            return ResponseJson($data,true,"Sukses mendapatkan token",200);

        }catch (\Exception $e){
            return ResponseJson(null,false,"Token verification failed ".$e->getMessage(),500);
        }
    }

}
