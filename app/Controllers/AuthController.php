<?php
include_once __DIR__ . "/app/models/UserModel.php";
include_once __DIR__ . "/app/controllers/Controller.php";

class AuthController extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function login() {

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new UserModel();

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
                    header("Location: " . $this->baseUrl . "/dashboard");
                    exit;
                } else {
                    $error = "Incorrect password.";
                }
            }
        }
    }

    include __DIR__ . "/app/views/auth/login.php";
}
        
    

    public function signup() {

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
                $userModel = new UserModel();

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

        include __DIR__ . "/app/views/auth/signup.php";
    }

    public function logout() {
        session_destroy();
        header("Location: " . $this->baseUrl . "/login");
        exit;
    }
}