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
}