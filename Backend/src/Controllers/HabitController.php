<?php
namespace App\Controllers;
use Helper\Response;

class HabitController{
    private $habitModel;

    public function __construct($habitModel) {
        $this->habitModel = $habitModel;
    }

    public function index(){
        $data = $this->habitModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show($habitID){
        $data = $this->habitModel->find($habitID);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "habit not found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function allByUser($userId){
        $data = $this->habitModel->allByUser($userId);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "no habit found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function store($userId, $data){
        if($this->habitModel->create($userId, $data)){
            Response::jsonResponse(200,[
                "status" => "success",
                "message" => "habit created successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed to create a habit"
            ]);
        }
    }

    public function update($habitID, $data){
        if($this->habitModel->update($habitID, $data)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "habit updated successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed to update a habit"
            ]);
        }
    }

    public function destroy($habitID){
        if($this->habitModel->delete($habitID)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "habit deleted successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "failed",
                "message" => "failed to delete a habit"
            ]);
        }
    }
}