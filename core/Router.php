<?php

namespace Core;

class Router{

    protected $container;
    protected $routes = [];

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function add($route, $params = []) {
        $this->routes[$route] = $params;
        return $this;
    }

    private function match() {
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($this->routes as $route => $params) {
            if ($uri == $route) {
                return $params;
            }
        }
        return false;
    }

    public function dispatch() {
        $params = $this->match();
        if ($params){

            $controller = 'App\\Controllers\\' . $params['controller'];
            $action = $params['action'] ?? 'index';
            $services = $params['services'] ?? [];
            $middlewares = $params['middlewares'] ?? [];

            if (class_exists($controller)) {

                // Middlewares
                if (isset($middlewares)) {
                    foreach ($middlewares as $middleware_name) {
                        $middleware = 'App\\Middlewares\\' . $middleware_name;
                        if (class_exists($middleware)) {
                            (new $middleware())->handle(new Request);
                        } else {
                            abort(500, "Router: Middleware class ($middlewareClass) not found!");
                        }
                    }
                }

                // Services
                $retrieved_services = [];
                if (isset($services)) {
                    foreach ($services as $service) {
                        $retrieved_services[] = $this->container->get($service);
                    }
                }
                
                // Controller
                $controller_object = new $controller(new Request, ...$retrieved_services);
                
                // Controller Action
                if (method_exists($controller_object, $action)) {
                    $controller_object->$action();
                } else {
                    abort(500, "Router: Method ($action) not found in controller ($controller)!");
                }
                
            } else {
                abort(500, "Router: Controller class ($controller) not found!");
            }
        } else {
            abort(404);
        }
    }
}

