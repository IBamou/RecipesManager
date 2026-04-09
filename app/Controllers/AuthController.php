<?php
include_once __DIR__ . "/../models/UserModel.php";

class AuthController extends User {

    public function login() {
        
    if (session_status() == PHP_SESSION_NONE) session_start();

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();

        $userInput = trim($_POST['username_or_email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($userInput) || empty($password)) {
            $error = "Please fill in all fields.";
        } else {

            // Detect email or username
            if (str_contains($userInput, '@')) {
                $user = $userModel->findByEmail($userInput);
            } else {
                $user = $userModel->findByUsername($userInput);
            }

            if (!$user) {
                $error = "User not found.";
            } else {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Incorrect password.";
                }
            }
        }
    }

    include __DIR__ . "/../views/auth/login.php";
}
        
    

    public function register() {
        if (session_status() == PHP_SESSION_NONE) session_start();

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username'] ??'');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $password;
            

            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = "Please fill in all fields.";
            } else {
                $userModel = new User();

                // Check if email already exists
                $existing = $userModel->findByEmail($email);
                if ($existing) {
                    $error = "This email is already registered.";
                } else {
                    $userModel->addUser($username, $email, $password);
                    $success = "Account created! You can now login.";
                }
            }
        }

        include __DIR__ . "/../views/auth/register.php";
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}