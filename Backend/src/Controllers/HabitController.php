<?php
namespace App\Controllers;

use Helper\EnsureOwnerShip;
use Helper\Response;

class HabitController{
    private $habitModel;
    private $userId;

    public function __construct($habitModel, $payLoad) {
        $this->habitModel = $habitModel;
        $this->userId = $payLoad->sub;
    }

    public function index(){
        $data = $this->habitModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show($habitID){
        $data = $this->habitModel->find($habitID);
        EnsureOwnerShip::verify($data, $this->userId);
        Response::jsonResponse(200, $data);
    }

    public function allByUser(){
        $data = $this->habitModel->allByUser($this->userId);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "no habit found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function store($data){
        if($this->habitModel->create($this->userId, $data)){
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

    public function update($habitId, $data){
        
        $habit = $this->habitModel->find($habitId);
        EnsureOwnerShip::verify($habit, $this->userId);
        if($this->habitModel->update($habitId, $data)){
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

    public function destroy($habitId){
        $habit = $this->habitModel->find($habitId);
        EnsureOwnerShip::verify($habit, $this->userId);
        if($this->habitModel->delete($habitId)){
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