<?php
namespace App\Controllers;

use Helper\Response;

class UserController{
    private $userModel;
    private $userId;


    public function __construct($userModel, $payLoad) {
        $this->userModel = $userModel;
        $this->userId = $payLoad->sub;
    }

    public function index(){
        $data = $this->userModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show(){
        $data = $this->userModel->find($this->userId);

        if(!$data){
            Response::jsonResponse(404,[
                "status" => "error",
                "message" => "user not found"
            ]);
        }else{
            unset($data["Password"]);
        Response::jsonResponse(200, $data);
        }
    }

    public function store($data){
        if($this->userModel->create($data)){
            $response = [
                "status" => "successful",
                "message"    => "user created"
            ];
            Response::jsonResponse(201, $response);
        }else{
            Response::jsonResponse(400,[
                "status" => "error",
                "message" => "failed to create usesr"
            ]);
        }
    }
    public function update($data){
        if($this->userModel->update($this->userId, $data)){
            $response = [
                "status" => "successful",
                "msg"    => "account data updated"
            ];
            Response::jsonResponse(200, $response);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed updating account data"
            ]);
        }
    }
    public function destroy(){
        if($this->userModel->delete($this->userId)){
            $response = [
                "status" => "successful",
                "msg"    => "account deleted"
            ];
            Response::jsonResponse(200, $response);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed deleting the account"
            ]);
        }
    }


}