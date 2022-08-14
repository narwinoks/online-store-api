<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\Products\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TagController extends BaseController
{
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);
        foreach ($request->title as $data) {
            // var_dump($data);
            $data = Tag::firstOrCreate([
                'product_id' => $request->product_id,
                'title' => $data,
            ], [
                'slug' => Str::slug($data, '-')
            ]);
        }

        if ($data->wasRecentlyCreated) {
            return $this->Response($data, "Successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("Something Wrong", "", Response::HTTP_NOT_FOUND);
        }
    }
    public function destory(Request $request)
    {
        $id = $request->id;
        $data = Tag::find($id);
        if ($data) {
            $data->delete();
            return $this->Response("", "Successfully", Response::HTTP_OK);
        }
    }
}
