<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Models/UserModel.php";

class ProfileController extends Controller {
    private $userModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    
    public function index() {
        $userId = $_SESSION['user']['id'] ?? 0;
        
        $user = $this->userModel->findById($userId);
        
        require_once __DIR__ . '/../Models/RecipeModel.php';
        require_once __DIR__ . '/../Models/CategoryModel.php';
        
        $recipeModel = new RecipeModel();
        $categoryModel = new CategoryModel();
        
        $totalRecipes = $recipeModel->countByUser($userId);
        $totalCategories = $categoryModel->countByUser($userId);
        
        include __DIR__ . "/../Views/profile/index.php";
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $bio = $_POST['bio'] ?? '';
            $birthday = $_POST['birthday'] ?? '';
            $userId = $_SESSION['user']['id'] ?? 0;
            
            if (!empty($name)) {
                $this->userModel->updateProfile($userId, $name, $bio, $birthday);
                $_SESSION['user']['name'] = $name;
            }
        }
        header("Location: " . $this->baseUrl . "/profile");
        exit();
    }
}