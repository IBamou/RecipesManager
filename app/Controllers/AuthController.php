<?php

class AuthController extends Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userInput = trim($_POST['username_or_email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($userInput) || empty($password)) {
                $error = "Please fill in all fields.";
            } else {
                if ($userInput === 'admin' && $password === 'password') {
                    $_SESSION['user'] = ['username' => $userInput];
                    header("Location: " . $this->baseUrl . "/dashboard");
                    exit;
                } else {
                    $error = "Invalid credentials.";
                }
            }
        }

        include __DIR__ . "/../Views/auth/login.php";
    }

    public function signup() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';

            if (empty($username) || empty($email) || empty($password)) {
                $error = "Please fill in all fields.";
            } elseif ($password !== $confirmPassword) {
                $error = "Passwords do not match.";
            } else {
                $success = "Account created! You can now login.";
            }
        }

        include __DIR__ . "/../Views/auth/signup.php";
    }

    public function logout() {
        session_destroy();
        header("Location: " . $this->baseUrl . "/login");
        exit;
    }
}
