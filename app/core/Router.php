<?php
require_once('../app/controllers/HomeController.php');
require_once ('../app/controllers/errors/HttpErrorController.php');

    class Router{

        public function dispatch($url){
            $url = trim($url, '/');
            

            $parts = $url ? explode('/', $url) : [];
            

            $controllerName = $parts[0] ?? 'Home';
            $controllerName = ucfirst($controllerName).'Controller';

            if(!class_exists($controllerName)){
                //Redirecionar para página 404.
                $controller = new HttpErrorController();
                $controller->NotFound();
                return;

            }

           $controller = new $controllerName();

           $actionName = $parts[1] ?? 'index';
           if(!method_exists($controller, $actionName)){
            //Exibir um 404
                $controller = new HttpErrorController();
                $controller->NotFound();
                return;
           }

           $params = array_slice($parts, 2);
           
           call_user_func_array([$controller, $actionName], $params);
        }
    }
