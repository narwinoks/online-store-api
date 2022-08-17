<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Size\SizeResource;
use App\Models\Api\Products\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SizeController extends BaseController
{
    public function index($id = null)
    {
        if (!empty($id)) {
            # code...
            $data = Size::find($id);
            $response = new  SizeResource($data);
        } else {
            $data = Size::get();
            $response = SizeResource::collection($data);
        }
        if ($data) {
            # code...
            return $this->Response($response, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:sizes'
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_NOT_FOUND);
        }
        $model = Size::create([
            'name' => $request->name
        ]);
        if ($model->wasRecentlyCreated) {
            # code...
            return $this->Response($model, "successfully", Response::HTTP_OK);
        }
        return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
    }

    public function update(Request $request)
    {
        $data = Size::find(1);
        // dd($data)
        // return $data;
        // dd($request->id);
        if ($data->name == $request->name) {
            $rules = 'required';
        } else {
            $rules = 'required|unique:sizes';
        }
        $validator = Validator::make($request->all(), [
            'name' => $rules
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_NOT_FOUND);
        }
        $data->update($request->all());
        if ($data) {
            # code...
            return $this->Response($data, "successfully", Response::HTTP_OK);
        }
        return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
    }

    public function destroy(Request $request)
    {
        $data = Size::find($request->id);
        if ($data) {
            $data->delete();
            return $this->Response("", "successfully", Response::HTTP_OK);
        }
        return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
    }
}
