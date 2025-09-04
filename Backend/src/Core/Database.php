<?php
namespace App\Core;

use mysqli;
use mysqli_sql_exception;

class Database{
    private $dbConfig;

    public function __construct($dbConfig) {
        $this->dbConfig = $dbConfig;
    }

    public function getConnection(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $connection = new mysqli($this->dbConfig["host"], $this->dbConfig["user"], $this->dbConfig["pass"],
            $this->dbConfig["name"]);
            return $connection;
    }
}