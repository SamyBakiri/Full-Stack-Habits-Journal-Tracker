<?Php
namespace Core;
use Core\App;
use Helper\Response;
use App\Controllers\Habit_logsController;

class Router{
    private $routes = [];
    
    public function __construct() {
        
    }

    public function addRoute($method,$uri, $handler){
        $this->routes[$method][] = [
            "path" => $uri,
            "handler" => $handler
        ];
    }
    public function get($uri, $handler){
        $this->addRoute("GET", $uri, $handler);
    }

    public function post($uri, $handler){
        $this->addRoute("POST", $uri, $handler);
    }

    public function put($uri, $handler){
        $this->addRoute("PUT", $uri, $handler);
    }

    public function delete($uri, $handler){
        $this->addRoute("DELETE", $uri, $handler);
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
            "message" => "url not found"
        ]);
    }
                // /users/{id}/books/{id} ==> #/users/(\d+)/books/(\d+)#
    public function convertPathToRegex($path):string{
        $regex = preg_replace("#\{\w+\}#", "(\d+)", $path);
        return "#^$regex/?$#";
    }



}

