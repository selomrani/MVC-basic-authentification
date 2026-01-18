<?php
namespace App\Controllers;
use App\Models\User;
class AuthController{
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $user = new User();
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                
                $user->save();

                header('Location: /login');
                exit;

            } catch (\Exception $e) {
                $error = $e->getMessage();
                require_once '/views/auth/register.php';
            }
        } else {
            require_once '/views/auth/register.php';
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