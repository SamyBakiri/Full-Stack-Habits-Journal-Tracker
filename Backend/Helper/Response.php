<?php
namespace Helper;

class Response{
    public static function jsonResponse($statusCode, $data){
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}