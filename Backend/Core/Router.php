<?Php
namespace Core;

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
            // 404 wrong http method 
        }
        
        foreach ($this->routes[$method] as $route) {
            $regex = $this->convertPathToRegex($route["path"]);
            if(preg_match($regex, $uri, $matches)){
                array_shift($matches);
                
                $controllerClassName = $route["handler"][0];
                $controllerMethodName = $route["handler"][1];
                
                $controllerInstance = new $controllerClassName();
                
                call_user_func_array([$controllerInstance, $controllerMethodName], $matches);
            }
        }
        //not found url 404
    }
                // /users/{id}/books/{id} ==> /users/(\d+)/books/(\d+)
    public function convertPathToRegex($path):string{
        $regex = preg_replace("#\{\w+\}#", "(\d+)", $path);
        return "#^$regex/?$#";
    }



}

