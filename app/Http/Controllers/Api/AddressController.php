<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Addrress\AddressResource;
use App\Models\Api\Address\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'province' => 'required',
            'city' => 'required',
            'districts' => 'required',
            'postalCode' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->Response("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        // $validator['user_id'] = $request->user()->id;
        $data = [
            'user_id' => $request->user()->id,
            'type_id' => $request->type,
            'province' => $request->province,
            'city' => $request->city,
            'districts' => $request->districts,
            'postalCode' => $request->postalCode,
            'content' => $request->content
        ];
        $model = Address::create($data);
        if ($model->wasRecentlyCreated) {
            $response = new AddressResource($model);
            return $this->Response($response, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Something Wrong", "", Response::HTTP_NO_CONTENT);
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'province' => 'required',
            'city' => 'required',
            'districts' => 'required',
            'postalCode' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->Response("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        // $validator['user_id'] = $request->user()->id;
        $address = Address::find($request->id);
        $data = [
            'id' > $request->id,
            'user_id' => $request->user()->id,
            'type_id' => $request->type,
            'province' => $request->province,
            'city' => $request->city,
            'districts' => $request->districts,
            'postalCode' => $request->postalCode,
            'content' => $request->content
        ];
        dd($address);
        // $model = Address::update($data);
        $address->update($data);
        if ($address->wasRecentlyCreated) {
            $response = new AddressResource($address);
            return $this->Response($response, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Something Wrong", "", Response::HTTP_NO_CONTENT);
        }
    }

    public function destroy(Request $request)
    {
        $address = Address::find($request->id);
        if ($address) {
            $address->delete();
            return $this->Response("", "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("empty data", "", Response::HTTP_NOT_FOUND);
        }
    }
}
