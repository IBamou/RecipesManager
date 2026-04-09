<?php
require_once __DIR__ . '/../Configs/Database.php';
require_once __DIR__ . '/../Models/RecipeModel.php';
require_once __DIR__ . "/Controller.php";

class RecipeController extends Controller {
    private $recipeModel;
    public function __construct() {
        parent::__construct();
        $this->recipeModel = new RecipeModel();
    }

    public function index() {
        $recipes = $this->recipeModel->getRecipes();
        include __DIR__ . "/../Views/recipe/index.php";
    }

    public function show() {
        $recipe_id = $_GET['recipe_id'] ?? null;
        $recipe = $this->recipeModel->getRecipeById($recipe_id);
        include __DIR__ . "/../Views/recipe/show.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipe_name = $_POST['name'] ?? null;
            $recipe_description = $_POST['description'] ?? null;
            $data = [
                'name' => $recipe_name,
                'description' => $recipe_description
            ];
            $this->recipeModel->createRecipe($data);
            header("Location: " . $this->baseUrl . "/recipes");
            exit();
        }
        include __DIR__ . "/../Views/recipe/create.php";
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipe_id = $_POST['recipe_id'] ?? null;
            $recipe_name = $_POST['name'] ?? null;
            $recipe_description = $_POST['description'] ?? null;
            $data = [
                'name' => $recipe_name,
                'description' => $recipe_description
            ];
            $this->recipeModel->updateRecipe($recipe_id, $data);
            header("Location: " . $this->baseUrl . "/recipes");
            exit();
        }
        $recipe_id = $_GET['id'] ?? null;
        $recipe = $this->recipeModel->getRecipeById($recipe_id);
        include __DIR__ . '/../Views/recipe/edit.php';
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