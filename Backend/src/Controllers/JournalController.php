<?php
namespace App\Controllers;
use Helper\Response;

class JournalController{
    private $journalModel;
    private $userId;

    public function __construct( $journalModel, $payLoad) {
        $this->journalModel = $journalModel[0];
        $this->userId = $payLoad->sub;
    }

    public function index(){
        $data = $this->journalModel->all();
        Response::jsonResponse(200, $data);
    }

    public function show($data){
        $data = $this->journalModel->find($this->userId, $data);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "journal not found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function allByUser(){
        $data = $this->journalModel->allByUser($this->userId);
        if(!$data){
            Response::jsonResponse(404, [
                "status" => "error",
                "message" => "no journal found"
            ]);
        }else{
            Response::jsonResponse(200, $data);
        }
    }

    public function store($data){
        if($this->journalModel->create($this->userId, $data)){
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
    
    public function update($data){
        $journal = $this->journalModel->find($this->userId, $data);
        if(!$journal){
            Response::jsonResponse(404, ["message" => "journal not found"]);
        }
        if($this->journalModel->update($this->userId, $data)){
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

    public function destroy($data){
        $journal = $this->journalModel->find($this->userId, $data);
        if(!$journal){
            Response::jsonResponse(404, ["message" => "journal not found"]);
        }
        if($this->journalModel->delete($this->userId, $data)){
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