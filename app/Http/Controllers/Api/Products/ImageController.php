<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\Products\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageController extends BaseController
{
    public function store(Request $request)
    {
        $all = $request->all();
        // dd($all);
        $images = $all['image'];
        // dd($images);
        $dir = 'avatar/products';
        $absoutPath = public_path($dir);
        foreach ($images as $image) {
            # code...
            if ($image instanceof UploadedFile) {
                $extension = $image->getClientOriginalExtension();
                $data['name'] = Str::random() . '.' . $extension;
                $image->move($absoutPath, $data['name']);
            }
            $data = Image::create([
                'product_id' => $request->product_id,
                'image' => $data['name']
            ]);
        }
        // $dir = 'avatar/products';
        // $absoutPath = public_path($dir);
        // // File::makeDirectory($absoutPath);
        // // images/dash2
        // if ($images instanceof UploadedFile) {
        //     return "okke";

        //     // test.jpg =test-resize.jpg
        //     // $filename = pathinfo($data['name'] . PATHINFO_FILENAME);
        //     $extension = $images->getClientOriginalExtension();
        //     $data['name'] = Str::random() . '.' . $extension;
        //     $images->move($absoutPath, $data['name']);
        // }
        return $this->Response("", "successfully", Response::HTTP_OK);
    }
}
