<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Models/FavoriteModel.php";
require_once __DIR__ . "/../Models/RecipeModel.php";

class FavoriteController extends Controller {
    private $favoriteModel;
    private $recipeModel;
    
    public function __construct() {
        parent::__construct();
        $this->favoriteModel = new FavoriteModel();
        $this->recipeModel = new RecipeModel();
    }

    public function index() {
        $userId = $_SESSION['user']['id'] ?? 0;
        $favorites = $this->favoriteModel->getUserFavorites($userId);
        $favoriteIds = $this->favoriteModel->getFavoriteIds($userId);
        include __DIR__ . "/../Views/favorites/index.php";
    }

    public function toggle() {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user'])) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $recipeId = (int) ($_POST['recipe_id'] ?? 0);

            if (!$recipeId) {
                echo json_encode(['success' => false, 'message' => 'Invalid recipe']);
                exit;
            }

            $isFavorited = $this->favoriteModel->isFavorited($userId, $recipeId);

            if ($isFavorited) {
                $this->favoriteModel->removeFavorite($userId, $recipeId);
                echo json_encode(['success' => true, 'favorited' => false]);
            } else {
                $this->favoriteModel->addFavorite($userId, $recipeId);
                echo json_encode(['success' => true, 'favorited' => true]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
        exit;
    }
}
