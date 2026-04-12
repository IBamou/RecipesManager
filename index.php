<?php
session_start();

define('BASE_URL', 'http://localhost/recipesManager');

require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/CategoryController.php';
require_once __DIR__ . '/app/Controllers/RecipeController.php';
require_once __DIR__ . '/app/Controllers/DashboardController.php';
require_once __DIR__ . '/app/Controllers/ProfileController.php';
require_once __DIR__ . '/app/Controllers/FavoriteController.php';

$url = (isset($_GET['url'])) && !empty($_GET['url']) ? $_GET['url'] : '/';

function isloggedin() {
    return isset($_SESSION['user']) ? true : false;
}

function requireLogin() {
    if (!isloggedin()) {
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }
}

switch ($url) {
    case '/':
    case 'home':
        include __DIR__ . '/app/Views/home.php';
        break;

    case 'auth/login':
        if (isloggedin()) {
            header("Location: " . BASE_URL . "/dashboard");
            exit;
        }
        (new AuthController())->login();
        break;

    case 'auth/signup':
        if (isloggedin()) {
            header("Location: " . BASE_URL . "/dashboard");
            exit;
        }
        (new AuthController())->signup();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'discover':
        requireLogin();
        (new RecipeController())->discover();
        break;

    case 'dashboard':
        requireLogin();
        (new DashboardController())->index();
        break;

    case 'profile':
        requireLogin();
        (new ProfileController())->index();
        break;

    case 'profile/update':
        requireLogin();
        (new ProfileController())->update();
        break;

    case 'categories':
        requireLogin();
        (new CategoryController())->index();
        break;

    case 'categories/show':
        requireLogin();
        (new CategoryController())->show();
        break;

    case 'categories/create':
        requireLogin();
        (new CategoryController())->create();
        break;

    case 'categories/edit':
        requireLogin();
        (new CategoryController())->edit();
        break;

    case 'categories/delete':
        requireLogin();
        (new CategoryController())->delete();
        break;

    case 'recipes':
        requireLogin();
        (new RecipeController())->index();
        break;

    case 'recipes/show':
        requireLogin();
        (new RecipeController())->show();
        break;

    case 'recipes/create':
        requireLogin();
        (new RecipeController())->create();
        break;

    case 'recipes/edit':
        requireLogin();
        (new RecipeController())->edit();
        break;

    case 'recipes/delete':
        requireLogin();
        (new RecipeController())->delete();
        break;

    case 'favorites':
        requireLogin();
        (new FavoriteController())->index();
        break;

    case 'favorites/toggle':
        requireLogin();
        (new FavoriteController())->toggle();
        break;

    default:
        http_response_code(404);
        include __DIR__ . '/app/Views/errors/404.php';
}