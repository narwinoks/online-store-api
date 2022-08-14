<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;
use App\Models\Api\Products\Category;
use App\Models\Api\Products\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
}
