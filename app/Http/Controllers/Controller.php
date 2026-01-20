<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//Response
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    use AuthorizesRequests, ValidatesRequests;
    protected function success($message, $data = [], $statuscode = 200,$status = true):JsonResponse
    {
       
        return response()->json([
            'status' => $status,
            'message' => $message,
            'code' => Response::HTTP_OK,
            'data' => $data,
            'errors'=>null
            ],Response::HTTP_OK);
    }

    protected function errorResponse($message, $data = null, $status = 422):JsonResponse
    {   
        
        return response()->json([
            'status' => false,
            'message' => $message,
            'code'=>$status,
            'data' => $data,
            
        ], $status);

    }
}
