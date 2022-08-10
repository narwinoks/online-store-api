<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Auth\AuthCollection;
use App\Http\Resources\Auth\AuthResource;
use App\Models\Api\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors());
        }
        $user = User::where('email', $request->email)->first();
        // dd($user->password);
        // dd(Hash::check($request->passsword, $user->password));
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->ErrorMessage("", "Your Account Is Not Found", Response::HTTP_NOT_FOUND);
        }
        $accessToken = $user->createToken($request->email)->plainTextToken;
        $response = collect($user);
        $merge = $response->merge(['token' => $accessToken]);
        // $dataResponse = $merge->all();
        // dd($dataResponse);
        $merge->all();
        return $this->Response($merge, "Successfully", Response::HTTP_OK);
    }
    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'password' => 'min:5'
        ]);
        if ($validator->fails()) {
            return  $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $accessToken = $user->createToken($request->email)->plainTextToken;
        $response = collect($user);
        $merge = $response->merge(['token' => $accessToken]);
        // $dataResponse = $merge->all();
        // dd($dataResponse);
        $merge->all();
        // $d = new AuthResource(User::fin);
        // $responsedata = new AuthCollection(User::all());
        return $this->Response($merge, "sucessfully", Response::HTTP_OK);
    }
    public function loginGoogle()
    {
    }
    public function loginFacebook()
    {
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->Response("", "Logout Success", Response::HTTP_OK);
    }
}
