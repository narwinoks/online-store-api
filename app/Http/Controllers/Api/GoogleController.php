<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
// use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;



class GoogleController extends BaseController
{
    //
    public function redirectToGoogle()
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }
    public function handleGoogleCallback()
    {
        // try {
        //     $socialiteUser = Socialite::driver('google')->stateless()->user();
        // } catch (ClientException $e) {
        //     return response()->json(['error' => 'Invalid credentials provided.'], 422);
        // }

        // /** @var User $user */
        // $user = User::query()
        //     ->firstOrCreate(
        //         [
        //             'email' => $socialiteUser->getEmail(),
        //         ],
        //         [
        //             'email_verified_at' => now(),
        //             'name' => $socialiteUser->getName(),
        //             'google_id' => $socialiteUser->getId(),
        //             'avatar' => $socialiteUser->getAvatar(),
        //         ]
        //     );

        // return response()->json([
        //     'user' => $user,
        //     'access_token' => $user->createToken('google-token')->plainTextToken,
        //     'token_type' => 'Bearer',
        // ]);
        $socialiteUser = Socialite::driver('google')->stateless()->user();
        if ($socialiteUser) {
            $user = User::firstOrCreate([
                'email' => $socialiteUser->getEmail()
            ], [
                'password' => Hash::make($socialiteUser->getEmail()),
                'google_id' => $socialiteUser->getId(),
                'avatar' => $socialiteUser->getAvatar()
            ]);
            $accessToken = $user->createToken($socialiteUser->getEmail())->plainTextToken;
            $response = collect($user);
            $merge = $response->merge(['token' => $accessToken]);
            // $dataResponse = $merge->all();
            // dd($dataResponse);
            $merge->all();
            return $this->Response($merge, "Successfully", Response::HTTP_OK);
        }
        return $this->ErrorMessage("Invalid credentials provided.", "", Response::HTTP_BAD_REQUEST);
    }
}
