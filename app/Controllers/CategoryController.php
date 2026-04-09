<?php
include __DIR__ . '/app/models/CategoryModel.php';
class CategoryController extends Controller {
    private $categoryModel;

    private $recipeModel;

    public function __construct() {
        parent::__construct();
        $this->categoryModel = new CategoryModel();
        $this->recipeModel = new RecipeModel();
    }

    public function index() {
        $categories = $this->categoryModel->getCategories();
        include __DIR__ . "/app/views/category/index.php";
    }

    public function show() {
        $category_id = $_GET['category_id'] ?? null;
        $category = $this->categoryModel->getCategoryById($category_id);
        $recipes = $this->recipeModel->getRecipeByCategory($category_id);
        include __DIR__ . "/app/views/category/show.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_name = $_POST['name'] ?? null;
            $category_description = $_POST['description'] ?? null;
            $data = [
                'name' => $category_name,
                'description' => $category_description
            ];
            $this->categoryModel->createCategory($data);
            header("Location: " . $this->baseUrl . "/categories");
            exit();
        }
        include __DIR__ . "/app/views/category/create.php";
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'] ?? null;
            $category_name = $_POST['name'] ?? null;
            $category_description = $_POST['description'] ?? null;
            $data = [
                'name' => $category_name,
                'description' => $category_description
            ];
            $this->categoryModel->updateCategory($category_id, $data);
            header("Location: " . $this->baseUrl . "/categories");
            exit();
        }
        $category_id = $_GET['id'] ?? null;
        $category = $this->categoryModel->getCategoryById($category_id);
        include __DIR__ . '/app/views/category/edit.php';
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