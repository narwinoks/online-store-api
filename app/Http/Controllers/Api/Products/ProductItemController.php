<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\Products\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class ProductItemController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'variant_id' => 'required',
            'size_id' => 'required',
            'price' => 'integer|required',
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $model = Item::create([
            'size_id' => $request->size_id,
            'variant_id' => $request->variant_id,
            'sku' => Str::random(5),
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity
        ]);
        if ($model->wasRecentlyCreated) {
            return $this->Response($model, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("something wrong", "", Response::HTTP_BAD_REQUEST);
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'variant_id' => 'required',
            'size_id' => 'required',
            'price' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $data = Item::find($request->id);
        if ($data) {
            $data->update([
                'id' => $request->id,
                'size_id' => $request->size_id,
                'variant_id' => $request->variant_id,
                'price' => $request->price,
                'discount' => $request->discount
            ]);
            if ($data) {
                return $this->Response($data, "successfully", Response::HTTP_OK);
            } else {
                return $this->ErrorMessage("something wrong", "", Response::HTTP_BAD_REQUEST);
            }
        } else {
            return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
        }
    }
    public function destroy(Request $request)
    {
        $data = Item::find($request->id);
        if ($data) {
            $data->delete();
            return $this->Response("", "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("something wrong", "", Response::HTTP_BAD_REQUEST);
        }
    }
    public function show($id)
    {
        $data = Item::find($id);
        if ($data) {
            # code...
            return $this->Response($data, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Data Not Found", "", Response::HTTP_NOT_FOUND);
        }
    }
}
