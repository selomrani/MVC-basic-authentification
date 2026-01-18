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
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_role'] = $user->getRole();
                $_SESSION['user_name'] = $user->getFirstname();

                if ($user->getRole() === 'admin') {
                    header('Location: /dashboard');
                } else {
                    header('Location: /');
                }
                exit;
            } else {
                $error = "Invalid email or password.";
                require_once '../app/views/auth/login.php';
            }
        } else {
            require_once '../app/views/auth/login.php';
        }
    }
}