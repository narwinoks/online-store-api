<?php

namespace App\Http\Controllers\Api\Card;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\Card\Card;
use App\Models\Api\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CardController extends BaseController
{
    public function index(Request $request)
    {
        $card = Card::with('product')->get();
        dd($card);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->Response("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $product = Product::find($request->product_id);
        // return $product;
        $data = Card::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'sku' => 0,
            'price' => $product->price,
            'discount' => $product->discount
        ]);

        if ($data->wasRecentlyCreated) {
            return $this->Response($data, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Something Wrong", "", Response::HTTP_BAD_REQUEST);
        }
    }
}
