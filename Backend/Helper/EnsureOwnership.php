<?php
namespace Helper;

class EnsureOwnerShip{

    public static function verify($data, $userId){
        if(!$data){
            Response::jsonResponse(404, ["message" => "resource not found"]);
        }
        if($data["User_Id"] !== $userId){
            Response::jsonResponse(403, ["message" => "access denied"]);
        }
    }
}