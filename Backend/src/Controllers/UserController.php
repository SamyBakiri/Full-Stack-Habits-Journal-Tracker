<?php
namespace app\Controller;

use Helper\Response;

class UserController{
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function index(){
        $data = $this->userModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show($id){
        $data = $this->userModel->find($id);
        if(!$data){
            Response::jsonResponse(404,[
                "status" => "error",
                "message" => "user not found"
            ]);
        }else{
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
    public function update($id, $data){
        if($this->userModel->update($id, $data)){
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
    public function destroy($id){
        if($this->userModel->delete($id)){
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