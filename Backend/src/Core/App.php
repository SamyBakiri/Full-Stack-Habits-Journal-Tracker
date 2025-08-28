<?php
namespace App\Core;
use App\Core\Database;

class App{
    public static function initialise($controllerClassName){
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
        $controllerInstance = new $controllerClassName($modelInctance);

        return $controllerInstance;
    }
}
// //controllerClassName = App\Controllers\UserController 
        
        // // initialise the model:
        // // get the name of the model class from the controller class name(controllerClassName = App\Controllers\UserController) 
        // $modelClassName = preg_replace("#Controller$#", "", $controllerClassName);
        // //modelClassName = App\Controllers\User 
        // $modelClassName = preg_replace("#Controllers#", "Models", $modelClassName);// get the name of the model class from the controller class name
        // //modelClassName = App\Models\User 