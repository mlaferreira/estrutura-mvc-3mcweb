<?php
namespace App\Core;

use App\Controllers\HomeController;
use App\Controllers\Errors\HttpErrorController;






    class Router{

        public function dispatch($url){
            $url = trim($url, '/');      
            $parts = $url ? explode('/', $url) : [];
            

            $controllerName = $parts[0] ?? 'Home';
           
            
            
            $controllerName = 'App\Controllers\\'. ucfirst($controllerName).'Controller';
            $actionName = $parts[1] ?? 'index';
             
           

           if(!class_exists($controllerName)){
                //Redirecionar para página 404.
                $controller = new HttpErrorController();
                $controller->notFound();
                return;

            }
            $controller = new $controllerName();

           if(!method_exists($controller, $actionName)){
            //Exibir um 404
                $controller = new HttpErrorController();
                $controller->notFound();
                return;
           }

           $params = array_slice($parts, 2);
           
           
           call_user_func_array([$controller, $actionName], $params);
        }
    }
