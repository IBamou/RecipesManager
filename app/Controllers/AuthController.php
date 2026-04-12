<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Models/UserModel.php";

class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    
    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userInput = trim($_POST['name_or_email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($userInput) || empty($password)) {
                $error = "Please fill in all fields.";
            } else {
                $user = null;
                
                if (strpos($userInput, '@') !== false) {
                    $user = $this->userModel->findByEmail($userInput);
                } else {
                    $user = $this->userModel->findByName($userInput);
                }

                if (!$user) {
                    $error = "User not found.";
                } elseif (!password_verify($password, $user['password'])) {
                    $error = "Incorrect password.";
                } else {
                    $_SESSION['user'] = $user;
                    header("Location: " . $this->baseUrl . "/dashboard");
                    exit;
                }
            }
        }

        include __DIR__ . "/../Views/auth/login.php";
    }

    public function signup() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                $error = "Please fill in all fields.";
            } elseif ($password !== $confirmPassword) {
                $error = "Passwords do not match.";
            } elseif ($this->userModel->emailExists($email)) {
                $error = "Email already exists.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->userModel->addUser($name, $email, $hashedPassword);
                $success = "Account created! You can now login.";
            }
        }

        include __DIR__ . "/../Views/auth/signup.php";
    }

    public function logout() {
        session_destroy();
        header("Location: " . $this->baseUrl . "/auth/login");
        exit;
    }
}
