<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Reviews\ReviewResource;
use App\Models\Api\Products\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $model = review::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'rating' => $request->rating,
            'content' => $request->content,
        ]);
        if ($model->wasRecentlyCreated) {
            $response = new ReviewResource($model);
            return $this->Response($response, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", ['error' => 'something wrong'], Response::HTTP_NOT_MODIFIED);
        }
    }
    public function destroy(Request $request)
    {
        $model = review::find($request->id);
        if ($model) {
            $model->delete();
            if ($model) {
                return $this->Response("", "successfully", Response::HTTP_OK);
            } else {
                return $this->ErrorMessage("", "Data Not found", Response::HTTP_NOT_MODIFIED);
            }
        }
    }
}
