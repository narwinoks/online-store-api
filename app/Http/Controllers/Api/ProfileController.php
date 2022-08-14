<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResousce;
use App\Models\Api\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileController extends BaseController
{
    public function index(Request $request)
    {
        if (!empty($request->user())) {
            $response = $request->user();
            // $response = User::find(1);

            // $data = new UserCollection($response);
            $data = new UserResousce($response);
            // $data= new UserResousce()
            // dd($data);
            return $this->Response($data, "successfully", Response::HTTP_OK);
        } else {
            return $this->ErrorMessage("", "", Response::HTTP_BAD_REQUEST);
        }
    }

    public function avatar(Request $request)
    {
        $all = $request->all();
        // dd($all);
        $image = $all['avatar'];

        $dir = 'avatar/user-profile';
        $absoutPath = public_path($dir);
        // File::makeDirectory($absoutPath);

        // images/dash2
        if ($image instanceof UploadedFile) {
            // test.jpg =test-resize.jpg
            // $filename = pathinfo($data['name'] . PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $data['name'] = Str::random() . '.' . $extension;
            $image->move($absoutPath, $data['name']);
        }

        $user = $request->user();
        $user->update([
            'avatar' => $data['name']
        ]);
        return $this->Response("", "successfully", Response::HTTP_OK);
        // dd($request->file('avatar'));
    }
    public function update(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->update($request->all());
            $response = new UserResousce($user);
            return $this->Response($response, "Successfully", Response::HTTP_OK);
        }
    }
}
