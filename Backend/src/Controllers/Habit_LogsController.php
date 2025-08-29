<?php
namespace App\Controllers;

use App\Models\Habit;
use Helper\EnsureOwnerShip;
use Helper\Response;

class Habit_logsController{
    private $habit_logsModel;
    private $habitModel;
    private $userId;

    public function __construct( $habit_logsModel, $habitModel, $payLoad) {
        $this->habit_logsModel = $habit_logsModel;
        $this->habitModel = $habitModel;
        $this->userId = $payLoad->sub;
    }

    public function index(){
        $data = $this->habit_logsModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show($habitId, $data){
        $habit = $this->habitModel->find($habitId);
        EnsureOwnerShip::verify($habit, $this->userId);
        $data = $this->habit_logsModel->find($habitId, $data);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "habit log not found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }
    
    public function allByHabit($habitId){
        $habit = $this->habitModel->find($habitId);
        EnsureOwnerShip::verify($habit, $this->userId);
        $data = $this->habit_logsModel->allById($habitId);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "not log found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function store($habitId, $data){
        $habit = $this->habitModel->find($habitId);
        EnsureOwnerShip::verify($habit, $this->userId);
        if($this->habit_logsModel->create($habitId, $data)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "habit log created successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed to create a habit log"
            ]);
        }
    }

    public function destroy($habitId, $date){
        $habit = $this->habitModel->find($habitId);
        EnsureOwnerShip::verify($habit, $this->userId);
        if($this->habit_logsModel->delete($habitId, $date)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "habit log deleted successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed to delete habit log"
            ]);
        }
    }

    public function update($habitId, $data){
        $habit = $this->habitModel->find($habitId);
        EnsureOwnerShip::verify($habit, $this->userId);
        if($this->habit_logsModel->update($habitId, $data)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "habit log updated successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" =>"failed to update habit log"
            ]);
        }
    }
}