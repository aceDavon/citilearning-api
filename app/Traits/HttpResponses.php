<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data, $message=null, $code=200)
    {
        return response()->json([
            "status" =>  "Request Successful.",
            "message" => $message,
            "data" => $data
        ], $code);
    }

     protected function failed($data, $message=null, $code)
    {
        return response()->json([
            "status" =>  "Request failed with code: $code.",
            "message" => $message,
            "data" => $data
        ], $code);
    }
}

?>
