<?php
session_start();

require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/CategoryController.php';
require_once __DIR__ . '/app/Controllers/RecipeController.php';
require_once __DIR__ . '/app/Controllers/DashboardController.php';

$url = (isset($_GET['url'])) ? $_GET['url'] : '/';

function isloggedin() {
    return isset($_SESSION['user']) ? true : false;
}
switch ($url) {
    case '/' || 'home':
        break;

    case 'login':
        (new AuthController())->login();
        break;

    case 'signup':
        (new AuthController())->signup();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;
    
    case 'dashboard':
        (new DashboardController())->index();
        break;
    
    // Categories Routes
    case 'categories':
        (new CategoryController())->index();
        break;
    
    case 'categories/show':
        (new CategoryController())->show();
        break;

    case 'categories/create':
        (new CategoryController())->create(); 
        break;

    case 'categories/edit':
        (new CategoryController())->edit();
        break;

    case 'categories/delete':
        (new CategoryController())->delete();
        break;

    // Recipes Routes
    case 'recipes':
        (new RecipeController())->index();
        break;

    case 'recipes/show':
        (new RecipeController())->show();
        break;

    case 'recipes/create':
        (new RecipeController())->create();    
        break;

    case 'recipes/edit':
        (new RecipeController())->edit();
        break;

    case 'recipes/delete':
        (new RecipeController())->delete();
        break;

    
    default:
        // Handle 404 error
        include __DIR__ . '/views/404.php';
}
