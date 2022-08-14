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
        if (is_numeric($request->email)) {
            $user = User::where('mobile', $request->email)->first();
        } else {
            $user = User::where('email', $request->email)->first();
        }
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
        if (is_numeric($request->register)) {
            $data['mobile'] = $request->register;
            $rules = 'required|unique:App\Models\Api\User,mobile';
        } else {
            $data['email'] = $request->register;
            $rules = 'required|email|unique:App\Models\Api\User,email';
        }
        $validator = Validator::make($request->all(), [
            'register' => $rules,
            'password' => 'min:5'
        ]);
        if ($validator->fails()) {
            return  $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $accessToken = $user->createToken($request->register)->plainTextToken;
        $response = collect($user);
        $merge = $response->merge(['token' => $accessToken]);
        // $dataResponse = $merge->all();
        // dd($dataResponse);
        $merge->all();
        // $d = new AuthResource(User::fin);
        // $responsedata = new AuthCollection(User::all());
        return $this->Response($merge, "sucessfully", Response::HTTP_OK);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->Response("", "Logout Success", Response::HTTP_OK);
    }
}
