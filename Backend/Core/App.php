<?php
namespace Core;
use Core\Database;

class App{
    public static function initialise($controllerClassName){
        //initialise database connection 
        $db_config = require __DIR__ . '/../Config/DB.php';
        $dataBase = new Database($db_config);
        $dbConnection = $dataBase->getConnection();

        //controllerClassName = App\Controllers\UserController 
        
        // initialise the model:
        // get the name of the model class from the controller class name(controllerClassName = App\Controllers\UserController) 
        $modelClassName = preg_replace("#Controller$#", "", $controllerClassName);
        //modelClassName = App\Controllers\User 
        $modelClassName = preg_replace("#Controllers#", "Models", $modelClassName);// get the name of the model class from the controller class name
        //modelClassName = App\Models\User 

        $modelInctance = new $modelClassName($dbConnection);// create a model instance

        //initialise the controller 
        $controllerInstance = new $controllerClassName($modelInctance);

        return $controllerInstance;
    }
}