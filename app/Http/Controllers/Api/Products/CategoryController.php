<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Api\Products\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends BaseController
{
    public function index($id = null)
    {
        if (!empty($id)) {
            $data = Category::find($id);
            $response = new CategoryResource($data);
        } else {

            $data = Category::where('parent_id', null)->with('children')->get();
            $response = new CategoryCollection($data);
        }
        return  $this->Response($response, "successfully", Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:categories'
            ]
        );
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $model = Category::create([
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content
        ]);
        $response = new CategoryResource($model);

        return $this->Response($response, "successfully", Response::HTTP_OK);
    }
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        if ($category->title == $request->title) {
            $rules = 'required';
        } else {
            $rules = 'required|unique:categories';
        }
        $validator = Validator::make(
            $request->all(),
            [
                'title' => $rules
            ]
        );
        if ($validator->fails()) {
            return $this->ErrorMessage("", $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $category->update([
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content
        ]);
        $response = new CategoryResource($category);
        // dd($response);
        return $this->Response($response, "successfully", Response::HTTP_OK);
    }
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        return $this->Response("", "Successfully", Response::HTTP_OK);
    }
}
