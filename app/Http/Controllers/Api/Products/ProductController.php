<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;
use App\Models\Api\Products\Category;
use App\Models\Api\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class ProductController extends BaseController
{
    public function index(Category $category)
    {
        $products = $category->Product()->with('image')->paginate(20);
        $response = new ProductCollection($products);
        if ($response) {
            return $this->Response($response, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Data Empty", "", Response::HTTP_NO_CONTENT);
        }
    }

    public function store(Request $request)
    {

        // dd($request->user()->id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'category_id' => 'required',
            'title' => 'required|max:50',
            'sku' => 'required|integer',
            'price' => 'required|integer',
            'discount' => 'integer',
            'quantity' => 'required|integer',
            'shop' => 'required'
        ]);


        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $model = Product::create([
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'Summary' => Str::limit($request->content, 100),
            'sku' => $request->sku,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'shop' => $request->shop,
            'content' => $request->content,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt
        ]);

        if ($model) {
            return $this->Response($model, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", ["error" => "something wrong"], Response::HTTP_NOT_MODIFIED);
        }
    }

    public function show(Product $product)
    {
        $response = new ProductResource($product);
        if ($response) {
            return $this->Response($response, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Data Empty", "", Response::HTTP_NO_CONTENT);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'category_id' => 'required',
            'title' => 'required|max:50',
            'sku' => 'required|integer',
            'price' => 'required|integer',
            'discount' => 'integer',
            'quantity' => 'required|integer',
            'shop' => 'required'
        ]);


        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $product = Product::find($request->id);
        $product->update([
            'user_id' => $request->user()->id,
            'id' => $request->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'Summary' => Str::limit($request->content, 100),
            'sku' => $request->sku,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'shop' => $request->shop,
            'content' => $request->content,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt
        ]);

        if ($product) {
            return $this->Response($product, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", ["error" => "something wrong"], Response::HTTP_NOT_MODIFIED);
        }
    }

    public function destroy(Request $request)
    {
        $model = Product::find($request->id);
        $model->delete();
        if ($model) {
            // return Response("", "Successfully", Response::HTTP_OK);
            return $this->Response("", "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", "something wrong", Response::HTTP_NOT_FOUND);
        }
    }
}
