<?php
namespace App\Core;
use App\Core\Database;

class App{
    public static function initialise($controllerClassName, $payLoad){
        //initialise database connection 
        $db_config = require __DIR__ . '/../Config/DB.php';
        $dataBase = new Database($db_config);
        $dbConnection = $dataBase->getConnection();

        $controllerModelMap = [
            "App\Controllers\UserController" => ["App\Models\User"],
            "App\Controllers\HabitController" => ["App\Models\Habit"],
            "App\Controllers\JournalController" => ["App\Models\Journal"],
            "App\Controllers\Habit_logsController" => ["App\Models\Habit_logs", "App\Models\Habit"],
            "App\Controllers\AuthController" => ["App\Models\User"]
        ];
        foreach ($controllerModelMap[$controllerClassName] as $model) {
            $modelClassName = $model ?? null;
            $modelInctances[] = new $modelClassName($dbConnection);// create a model instance
        }
        
        //initialise the controller 
        
        $controllerInstance = new $controllerClassName($modelInctances, $payLoad);

        return $controllerInstance;
    }
}
