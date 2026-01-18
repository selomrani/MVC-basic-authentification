<?php
namespace App\Core;

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Models\User;

class Router{
    public function dispatch(){
        $path = $_SERVER['PATH_INFO'];
        switch($path){
            case '/':
                $controller = new AuthController();
                $controller->login(); 
                break;
            case '/register':
                $controller = new AuthController();
                $controller->register();
                break;
            case '/login' :
            $controller = new AuthController();
            $controller->login();
            break;
            case '/dashboard' :
                $controller = new AdminController();
                $controller->index();
                break;
            default:
                http_response_code(404);
                echo "<h1>404 - Page Not Found</h1>";
                break;
        }
    }
}