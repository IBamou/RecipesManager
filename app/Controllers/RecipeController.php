<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Models/RecipeModel.php";

class RecipeController extends Controller {
    private $recipeModel;
    
    public function __construct() {
        parent::__construct();
        $this->recipeModel = new RecipeModel();
    }

    public function index() {
        $userId = $_SESSION['user']['id'] ?? 0;
        $recipes = $this->recipeModel->getRecipesByUser($userId);
        include __DIR__ . "/../Views/recipes/index.php";
    }

    public function discover() {
        $recipes = $this->recipeModel->getAllRecipes();
        $categories = $this->recipeModel->getCategories();
        include __DIR__ . "/../Views/recipes/discover.php";
    }

    public function show() {
        $recipe_id = $_GET['recipe_id'] ?? null;
        $recipe = $this->recipeModel->getRecipeById($recipe_id);
        include __DIR__ . "/../Views/recipes/show.php";
    }

    public function create() {
        $categories = $this->recipeModel->getCategories();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'user_id' => $_SESSION['user']['id'] ?? 0,
                'category_id' => $_POST['category_id'] ?? null,
                'ingredients' => $_POST['ingredients'] ?? '',
                'instructions' => $_POST['instructions'] ?? '',
                'preparation_time' => $_POST['preparation_time'] ?? 0,
                'cooking_time' => $_POST['cooking_time'] ?? 0,
                'difficulty' => $_POST['difficulty'] ?? 'medium',
                'image_url' => $_POST['image_url'] ?? ''
            ];
            $this->recipeModel->storeRecipe($data);
            header("Location: " . $this->baseUrl . "/recipes");
            exit();
        }
        include __DIR__ . "/../Views/recipes/create.php";
    }

    public function edit() {
        $categories = $this->recipeModel->getCategories();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['recipe_id'] ?? 0,
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'category_id' => $_POST['category_id'] ?? null,
                'ingredients' => $_POST['ingredients'] ?? '',
                'instructions' => $_POST['instructions'] ?? '',
                'preparation_time' => $_POST['preparation_time'] ?? 0,
                'cooking_time' => $_POST['cooking_time'] ?? 0,
                'difficulty' => $_POST['difficulty'] ?? 'medium',
                'image_url' => $_POST['image_url'] ?? ''
            ];
            $this->recipeModel->updateRecipe($data);
            header("Location: " . $this->baseUrl . "/recipes");
            exit();
        }
        $recipe_id = $_GET['id'] ?? null;
        $recipe = $this->recipeModel->getRecipeById($recipe_id);
        include __DIR__ . '/../Views/recipes/edit.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipe_id = $_POST['recipe_id'] ?? null;
            $this->recipeModel->deleteRecipe($recipe_id);
            header("Location: " . $this->baseUrl . "/recipes");
            exit();
        }
    }
}
