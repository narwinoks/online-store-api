<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function Response($result = "", $message, $status)
    {
        if (!empty($result)) {
            $response = [
                'success' => true,
                'message' => $message,
                'data' => $result
            ];
        } else {
            $response = [
                'success' => true,
                'message' => $message
            ];
        }

        return response()->json($response, $status);
    }

    public function ErrorMessage($error, $errorMessage = [], $code = 404 ?? $code)
    {
        $response = [
            'success' => false,
            'message' => $error
        ];
        if (!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $code);
    }
}
