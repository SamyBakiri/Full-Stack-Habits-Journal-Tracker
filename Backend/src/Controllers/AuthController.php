<?php
namespace App\Controllers;

use App\Services\JwtService;
use Helper\Response;

class AuthController{
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function register($data){
        if($this->userModel->create($data)){
            Response::jsonResponse(200, [
                "status" =>"success",
                "message" =>"account created successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" =>"failed to create account"
            ]);
        }
    }

    public function login($data){
        if($user = $this->userModel->findByEmail($data["Email"])){
            if(password_verify($data["Password"], $user["Password"])){
                $jwtservice = new JwtService;
                $token = $jwtservice->generateToken($user["User_Id"]);
                Response::jsonResponse(200, [
                    "token" => $token
                ]);
            }
        }else{
            
            Response::jsonResponse(404, [
                "status" => "error",
                "message" =>"user not found"
            ]);
        }
    }
}