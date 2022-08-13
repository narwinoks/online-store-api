<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResousce;
use App\Models\Api\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends BaseController
{
    public function index(Request $request)
    {
        if (!empty($request->user())) {
            $response = $request->user();
            // $response = User::find(1);

            // $data = new UserCollection($response);
            $data = new UserResousce($response);
            // $data= new UserResousce()
            // dd($data);
            return $this->Response($data, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", "", Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
    }
}
