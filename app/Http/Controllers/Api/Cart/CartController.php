<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartCollection;
use App\Models\Api\Cart\Cart;
use App\Models\Api\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CartController extends BaseController
{
    public function index(Request $request)
    {
        $card =$request->user()->Cart()->get();
        $response=new CartCollection($card);
        if ($response) {
          return $this->Response($response,"successfully",Response::HTTP_OK);
        }else{
            return $this->ErrorMessage("Not Found","",Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'variant_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->Response("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $data = Cart::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'variant_id' => $request->variant_id,
            'item_id' => $request->item_id,
            'discount' => $request->discount
        ]);

        if ($data->wasRecentlyCreated) {
            return $this->Response($data, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Something Wrong", "", Response::HTTP_BAD_REQUEST);
        }
    }
    public function destory(Request $request){
        $data=Cart::find($request->id);
        if ($data) {
            # code...
            $data->delete();
            return $this->Response("","Successfully",Response::HTTP_OK);
        }else{
            return $this->ErrorMessage("","ID Not Found",Response::HTTP_OK);
        }
    }
}
