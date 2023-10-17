<?php
class Router
{
    private $routes = [];
    private $controller;
    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function addRoute($action, $controller, $method)
    {
        $this->routes[$action] = [
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public function route()
    {
        $action = $_GET['action'] ?? 'index';
        $id = $_GET['id'] ?? null;

        if (array_key_exists($action, $this->routes)) {
            $route = $this->routes[$action];
            $controller = $route['controller'];
            $method = $route['method'];

            if ($id) {
                $controller->$method($id);
            } else {
                $controller->$method();
            }
        } else {
            
            $this->routes['index']['controller']->index();
        }
    }
}
?>