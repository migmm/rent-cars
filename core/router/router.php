<?php

class Router
{
    private $routes = [];
    private $controller;
    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function addRoute($action, $method, $middleware = null)
    {
        $this->routes[$action] = [
            'method' => $method,
            'middleware' => $middleware,
        ];
    }

    public function route()
    {
        $action = $_GET['action'] ?? 'index';
        $id = $_GET['id'] ?? null;

        if (array_key_exists($action, $this->routes)) {
            $route = $this->routes[$action];
            $method = $route['method'];
            $middleware = $route['middleware'];

            if ($middleware) {
                $middleware->handle($action);
            }

            if (method_exists($this->controller, $method)) {
                if ($id) {
                    $this->controller->$method($id);
                } else {
                    $this->controller->$method();
                }
            } else {
                //$controller->$method();
                echo "Error: Method does not exist in controller.";
            }
        } else {
            //$this->routes['index']['controller']->index();
            echo "Error: Action is not registered.";
        }
    }
}

?>