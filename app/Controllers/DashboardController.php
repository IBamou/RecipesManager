<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Models/RecipeModel.php";
require_once __DIR__ . "/../Models/CategoryModel.php";
require_once __DIR__ . "/../Models/FavoriteModel.php";

class DashboardController extends Controller {
    private $recipeModel;
    private $categoryModel;
    private $favoriteModel;
    
    public function __construct() {
        parent::__construct();
        $this->recipeModel = new RecipeModel();
        $this->categoryModel = new CategoryModel();
        $this->favoriteModel = new FavoriteModel();
    }
    
    public function index() {
        $userId = $_SESSION['user']['id'] ?? 0;
        
        $totalRecipes = $this->recipeModel->countByUser($userId);
        $totalCategories = $this->categoryModel->countByUser($userId);
        $recentRecipes = $this->recipeModel->getRecipesByUser($userId);
        $recentRecipes = array_slice($recentRecipes, 0, 3);
        
        // Stats
        $allRecipes = $this->recipeModel->getRecipesByUser($userId);
        $myFavorites = $this->favoriteModel->getFavoriteIds($userId);
        $favoriteCount = count($myFavorites);
        
        $totalTime = 0;
        $easyCount = 0;
        $hardCount = 0;
        foreach ($allRecipes as $recipe) {
            if (strtolower($recipe['difficulty']) === 'easy') {
                $easyCount++;
            } elseif (strtolower($recipe['difficulty']) === 'hard') {
                $hardCount++;
            }
            $totalTime += ($recipe['preparation_time'] + $recipe['cooking_time']);
        }
        
        include __DIR__ . '/../Views/dashboard/index.php';
    }
}
