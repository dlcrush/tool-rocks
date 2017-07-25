<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class APIController extends \App\Http\Controllers\Controller {

    protected $statusCode = 200;

    public function respond($data, $headers = []) {
        return response()->json($data, $this->statusCode, $headers);
    }

}
