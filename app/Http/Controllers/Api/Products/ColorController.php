<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Color\ColorResource;
use App\Models\Api\Products\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ColorController extends BaseController
{
    public function index($id = null)
    {
        if (!empty($id)) {
            # code...
            $data = Color::find($id);
            $response = new  ColorResource($data);
        } else {
            $data = Color::get();
            $response = ColorResource::collection($data);
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
            'color' => 'required|unique:colors'
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_NOT_FOUND);
        }
        $model = Color::create([
            'color' => $request->color,
            'code_Color' => $request->code_Color
        ]);
        if ($model->wasRecentlyCreated) {
            # code...
            return $this->Response($model, "successfully", Response::HTTP_OK);
        }
        return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
    }

    public function update(Request $request)
    {
        $data = Color::find(1);
        // dd($data)
        // return $data;
        // dd($request->id);
        if ($data->name == $request->name) {
            $rules = 'required';
        } else {
            $rules = 'required|unique:colos';
        }
        $validator = Validator::make($request->all(), [
            'color' => $rules
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
        $data = Color::find($request->id);
        if ($data) {
            $data->delete();
            return $this->Response("", "successfully", Response::HTTP_OK);
        }
        return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
    }
}
