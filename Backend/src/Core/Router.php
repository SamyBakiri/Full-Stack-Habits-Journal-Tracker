<?Php
namespace App\Core;

use App\Middlewares\AuthMiddleware;
use App\Services\JwtService;
use App\Core\App;
use Helper\InputValidator;
use Helper\Response;

class Router{
    private $routes = [];
    
    public function __construct() {
        
    }

    public function addRoute($method,$uri, $handler, $protected, $rules){
        $this->routes[$method][] = [
            "path" => $uri,
            "handler" => $handler,
            "protected" =>$protected,
            "rules" => $rules
        ];
    }
    public function get($uri, $handler, $protected = true, $rules = null){
        $this->addRoute("GET", $uri, $handler, $protected, $rules);
    }

    public function post($uri, $handler, $protected = true, $rules = null){
        $this->addRoute("POST", $uri, $handler, $protected, $rules);
    }

    public function put($uri, $handler, $protected = true, $rules = null){
        $this->addRoute("PUT", $uri, $handler, $protected, $rules);
    }

    public function delete($uri, $handler, $protected = true, $rules = null){
        $this->addRoute("DELETE", $uri, $handler, $protected, $rules);
    }

    //  users/123/books/12 
    public function dispatch($uri, $method){
        $uri = parse_url($uri, PHP_URL_PATH);
        if(!isset($this->routes[$method])){
            Response::jsonResponse(404,[
                "status" => "error",
                "message" => "http method not allowed"
            ]);
            // 404 wrong http method 
        }
        
        foreach ($this->routes[$method] as $route) {
            $regex = $this->convertPathToRegex($route["path"]);
            if(preg_match($regex, $uri, $matches)){
                array_shift($matches); //delete the first match (the uri )
                $payLoad = null;
                if($route["protected"]){
                    $authMiddleWare = new AuthMiddleware;
                    $jwtService = new JwtService;
                    $payLoad = $authMiddleWare->checkAuth($jwtService);
                }
                $controllerClassName = $route["handler"][0];
                $controllerMethodName = $route["handler"][1];
                $controllerInstance = App::initialise($controllerClassName, $payLoad);

                $args = $matches;
                
                    $data = json_decode(file_get_contents("php://input"), true);
                    if($route["rules"]){
                    $data = InputValidator::validate($data, $route["rules"]);
                }
                    $args[] = $data;
                
                
                call_user_func_array([$controllerInstance, $controllerMethodName], $args);
            }
        }
        //not found url 404
        Response::jsonResponse(404,[
            "status" => "error",
            "message" => "url not  found"
        ]);
    }
                // /users/{id}/habits/{id} ==> #/users/(\d+)/habits/(\d+)#
    public function convertPathToRegex($path):string{
        $regex = preg_replace("#\{\w+\}#", "(\d+)", $path);
        return "#^$regex/?$#";
    }



}

