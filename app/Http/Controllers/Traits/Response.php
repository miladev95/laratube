<?php

namespace App\Http\Controllers\Traits;

trait Response
{
    protected function successResponse($message = '', $data = [], $code = 200, $header = [])
    {
        return response([
            'message' => $message,
            'data' => $data,
        ], $code, $header);
    }

    protected function errorResponse($message, $code = 404,$data = [], $header = [])
    {
        return response([
            'message' => $message,
            'data' => $data,
        ], $code, $header);
    }
}
