<?php
namespace app\Controller;
use Helper\Response;

class Habit_LogsController{
    private $habit_logsModel;

    public function __construct( $habit_logsModel) {
        $this->habit_logsModel = $habit_logsModel;
    }

    public function index(){
        $data = $this->habit_logsModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show($habitId, $date){
        $data = $this->habit_logsModel->find($habitId, $date);
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