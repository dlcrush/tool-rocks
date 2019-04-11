<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class APIController extends \App\Http\Controllers\Controller {

    public function respond($data, $statusCode=200, $headers = []) {
        return response()->json($data, $statusCode, $headers);
    }

    public function respondNotFound($options=[]) {
        return $this->respondError([
            'statusCode' => 404
        ]);
    }

    public function respondError($options=[]) {
        $data = [
            'error' => [
                'message' => isset($options['message']) ? $options['message'] : 'An error has occured.',
                'statusCode' => isset($options['statusCode']) ? $options['statusCode'] : 500
            ]
        ];

        return $this->respond($data, isset($options['statusCode']) ? $options['statusCode'] : 500);
    }

}
