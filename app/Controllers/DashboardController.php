<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Models/RecipeModel.php";
require_once __DIR__ . "/../Models/CategoryModel.php";

class DashboardController extends Controller {
    private $recipeModel;
    private $categoryModel;
    
    public function __construct() {
        parent::__construct();
        $this->recipeModel = new RecipeModel();
        $this->categoryModel = new CategoryModel();
    }
    
    public function index() {
        $userId = $_SESSION['user']['id'] ?? 0;
        
        $totalRecipes = $this->recipeModel->countByUser($userId);
        $totalCategories = $this->categoryModel->countByUser($userId);
        $recentRecipes = $this->recipeModel->getRecipesByUser($userId);
        $recentRecipes = array_slice($recentRecipes, 0, 5);
        
        $allRecipes = $this->recipeModel->getRecipesByUser($userId);
        $easyRecipes = 0;
        $totalTime = 0;
        foreach ($allRecipes as $recipe) {
            if (strtolower($recipe['difficulty']) === 'easy') {
                $easyRecipes++;
            }
            $totalTime += ($recipe['preparation_time'] + $recipe['cooking_time']);
        }
        
        include __DIR__ . '/../Views/dashboard/index.php';
    }
}
