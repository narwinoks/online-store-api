<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\Products\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class VariantsController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'sku' => 'integer',
            'price' => 'integer',
            'quantity' => 'integer'
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $model = Variant::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'sku' => Str::random(16),
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity
        ]);
        if ($model->wasRecentlyCreated) {
            # code...
            return $this->Response($model, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", "", Response::HTTP_BAD_REQUEST);
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'sku' => 'integer',
            'price' => 'integer',
            'quantity' => 'integer'
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $data = Variant::find($request->id);
        $data->update([
            'id' => $request->id,
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity
        ]);
        if ($data) {
            # code...
            return $this->Response($data, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", "", Response::HTTP_BAD_REQUEST);
        }
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = Variant::find($id);
        if ($data) {
            # code...
            $data->delete();
            return $this->Response("", "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("somthing wrong", "", Response::HTTP_NOT_FOUND);
        }
    }

    public function tes()
    {
        $data = Variant::with('color')->get();
        dd($data);
    }
}
