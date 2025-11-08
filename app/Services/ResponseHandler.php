<?php

namespace App\Services;
use Illuminate\Http\Response;

class ResponseHandler {

    public function returnResponse($response_code = 404,$success = false,$message = array('error'=>array('Something went wrong...')),$result = []){
        $response = [
            'error' => array('code' => $response_code, 'message' => $message),
            'result' => $result,
            'success'=> $success
        ];

        return response()->json($response,$response_code);
    }
}   
