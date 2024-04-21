<?php

namespace Helpers;

class HttpHelpers
{
    public static function generalJsonResponse($code, $message, $prefix){
        http_response_code($code);
        return json_encode([$prefix => $message]);
    }

    public static function jsonResponse($code, $data){
        http_response_code($code);
        return json_encode($data);
    }
}
