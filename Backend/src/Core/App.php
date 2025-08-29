<?php
namespace App\Core;
use App\Core\Database;
use App\Models\Habit;

class App{
    public static function initialise($controllerClassName, $payLoad){
        //initialise database connection 
        $db_config = require __DIR__ . '/../Config/DB.php';
        $dataBase = new Database($db_config);
        $dbConnection = $dataBase->getConnection();

        $controllerModelMap = [
            "App\Controllers\UserController" => "App\Models\User",
            "App\Controllers\HabitController" => "App\Models\Habit",
            "App\Controllers\JournalController" => "App\Models\Journal",
            "App\Controllers\Habit_logsController" => "App\Models\Habit_logs",
            "App\Controllers\AuthController" => "App\Models\User"
        ];
        $modelClassName = $controllerModelMap[$controllerClassName] ?? null;
        
        $modelInctance = new $modelClassName($dbConnection);// create a model instance

        //initialise the controller 
        if($controllerClassName === "App\Controllers\Habit_logsController"){
            return $controllerInstance = new $controllerClassName($modelInctance, new Habit($dbConnection) ,$payLoad);
        }
        $controllerInstance = new $controllerClassName($modelInctance, $payLoad);

        return $controllerInstance;
    }
}
