<?php

namespace App\Util;

class ResponseFormatter
{
    private $message;
    private $statusCode;
    private $data;
    private $isSuccess;

    public static function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($isSuccess):
            return response()->json([
                'message' => $message,
                'results' => $data,
                'error' => false,
            ], $statusCode);
        else:
            if($data){
                return response()->json([
                    'message' => $message,
                    'error' => true,
                    'data'=>$data
                ], $statusCode);
            }
            return response()->json([
                'message' => $message,
                'error' => true,
            ], $statusCode);
        endif;
    }

    public static function success($message, $data, $statusCode = 200)
    {
        return self::coreResponse($message, $data, $statusCode);
    }

    public static function error($message, $statusCode = 500, $data=null)
    {
        return self::coreResponse($message, null, $statusCode, false);
    }

    public static function notFound($message, $statusCode = 404, $data=null)
    {
        return self::coreResponse($message, null, $statusCode, false);
    }

    public static function unauthorized($message, $statusCode = 401, $data=null)
    {
        return self::coreResponse($message, null, $statusCode, false);
    }
}