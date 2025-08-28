<?Php
namespace App\Core;

use App\Middlewares\AuthMiddleware;
use App\Services\JwtService;
use App\Core\App;
use Helper\Response;

class Router{
    private $routes = [];
    
    public function __construct() {
        
    }

    public function addRoute($method,$uri, $handler, $protected){
        $this->routes[$method][] = [
            "path" => $uri,
            "handler" => $handler,
            "protected" =>$protected
        ];
    }
    public function get($uri, $handler, $protected = true){
        $this->addRoute("GET", $uri, $handler, $protected);
    }

    public function post($uri, $handler, $protected = true){
        $this->addRoute("POST", $uri, $handler, $protected);
    }

    public function put($uri, $handler, $protected = true){
        $this->addRoute("PUT", $uri, $handler, $protected);
    }

    public function delete($uri, $handler, $protected = true){
        $this->addRoute("DELETE", $uri, $handler, $protected);
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
                if($route["protected"]){
                    $authMiddleWare = new AuthMiddleware;
                    $jwtService = new JwtService;
                    $payLoad = $authMiddleWare->checkAuth($jwtService);
                }

                $controllerClassName = $route["handler"][0];
                $controllerMethodName = $route["handler"][1];
                $controllerInstance = App::initialise($controllerClassName);

                $args = $matches;
                
                    $data = json_decode(file_get_contents("php://input"), true);
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
                // /users/{id}/books/{id} ==> #/users/(\d+)/books/(\d+)#
    public function convertPathToRegex($path):string{
        $regex = preg_replace("#\{\w+\}#", "(\d+)", $path);
        return "#^$regex/?$#";
    }



}

