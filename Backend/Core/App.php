<?php
namespace Core;
use Core\Database; 

class App{
    public static function initialise($handler){
        $controllerClassName = $handler[0];
        $controllerMethodName = $handler[1];
        
        //initialise database connection 
        $db_config = require __DIR__ . '/../Config/DB.php';
        $dataBase = new Database($db_config);
        $dbConnection = $dataBase->getConnection();

        // initialise the model         
        $modelClassName = str_replace("Controller", "", $controllerClassName); // get the name of the model class from the controller class name
        $modelInctance = new $modelClassName($dbConnection);// create a model instance

        //initialise the controller 
        $controllerInstance = new $controllerClassName($modelInctance);

        return $controllerInstance;
    }
}