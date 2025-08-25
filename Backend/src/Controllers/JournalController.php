<?php
namespace app\Controller;
use Helper\Response;

class JournalController{
    private $journalModel;

    public function __construct( $journalModel) {
        $this->$journalModel = $journalModel;
    }

    public function index(){
        $data = $this->journalModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show($userId, $date){
        $data = $this->journalModel->find($userId, $date);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "journal not found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function allByUser($userId){
        $data = $this->journalModel->allByUser($userId);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "no journal found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function store($userId, $date, $data){
        if($this->journalModel->create($userId, $date, $data)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "journal created successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed to create journal"
            ]);
        }
    }
    
    public function update($userId, $date, $data){
        if($this->journalModel->update($userId, $date, $data)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "journal updated successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed to update journal"
            ]);
        }
    }

    public function destroy($userId, $date){
        if($this->journalModel->delete($userId, $date)){
            Response::jsonResponse(200, [
                "status" => "success",
                "message" => "journal deleted successfully"
            ]);
        }else{
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "failed to delete journal"
            ]);
        }
    }

}