<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Models/CategoryModel.php";

class CategoryController extends Controller {
    private $categoryModel;
    
    public function __construct() {
        parent::__construct();
        $this->categoryModel = new CategoryModel();
    }

    public function index() {
        $userId = $_SESSION['user']['id'] ?? 0;
        $categories = $this->categoryModel->getCategoriesByUser($userId);
        include __DIR__ . "/../Views/categories/index.php";
    }

    public function show() {
        $category_id = $_GET['category_id'] ?? null;
        $category = $this->categoryModel->getCategoryById($category_id);
        
        require_once __DIR__ . "/../Models/RecipeModel.php";
        $recipeModel = new RecipeModel();
        $recipes = $recipeModel->getRecipesByCategory($category_id, $_SESSION['user']['id'] ?? 0);
        
        include __DIR__ . "/../Views/categories/show.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'] ?? 0;
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'user_id' => $userId
            ];
            $this->categoryModel->storeCategory($data);
            
            header("Location: " . $this->baseUrl . "/categories");
            exit();
        }
        include __DIR__ . "/../Views/categories/create.php";
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['category_id'] ?? 0,
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];
            $this->categoryModel->updateCategory($data);
            header("Location: " . $this->baseUrl . "/categories");
            exit();
        }
        $category_id = $_GET['id'] ?? null;
        $category = $this->categoryModel->getCategoryById($category_id);
        include __DIR__ . '/../Views/categories/edit.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'] ?? null;
            $this->categoryModel->deleteCategory($category_id);
            header("Location: " . $this->baseUrl . "/categories");
            exit();
        }
    }
}
