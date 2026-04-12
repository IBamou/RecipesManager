<?php
require_once __DIR__ . "/../Configs/Database.php";

class RecipeModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function getRecipes() {
        try {
            $sql = 'SELECT * FROM recipes ORDER BY created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getAllRecipes() {
        try {
            $sql = 'SELECT recipes.*, categories.name as category_name 
                    FROM recipes 
                    LEFT JOIN categories ON recipes.category_id = categories.id 
                    ORDER BY recipes.created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getRecipesByUser(int $userId, string $search = '') {
        try {
            $sql = 'SELECT recipes.*, categories.name as category_name 
                    FROM recipes 
                    LEFT JOIN categories ON recipes.category_id = categories.id 
                    WHERE recipes.user_id = :user_id';
            
            if (!empty($search)) {
                $sql .= ' AND (recipes.name LIKE :search OR recipes.description LIKE :search2)';
            }
            
            $sql .= ' ORDER BY recipes.created_at DESC';
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            
            if (!empty($search)) {
                $searchTerm = '%' . $search . '%';
                $stmt->bindParam(':search', $searchTerm);
                $stmt->bindParam(':search2', $searchTerm);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function countByUser(int $userId): int {
        try {
            $sql = 'SELECT COUNT(*) as count FROM recipes WHERE user_id = :user_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function getRecipeById($id) {
        try {
            $sql = 'SELECT recipes.*, categories.name as category_name 
                    FROM recipes 
                    LEFT JOIN categories ON recipes.category_id = categories.id 
                    WHERE recipes.id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function storeRecipe(array $data) {
        try {
            $sql = 'INSERT INTO recipes (name, description, user_id, category_id, ingredients, instructions, preparation_time, cooking_time, difficulty, image_url) 
                    VALUES (:name, :description, :user_id, :category_id, :ingredients, :instructions, :preparation_time, :cooking_time, :difficulty, :image_url)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindParam(':ingredients', $data['ingredients'], PDO::PARAM_STR);
            $stmt->bindParam(':instructions', $data['instructions'], PDO::PARAM_STR);
            $stmt->bindParam(':preparation_time', $data['preparation_time'], PDO::PARAM_INT);
            $stmt->bindParam(':cooking_time', $data['cooking_time'], PDO::PARAM_INT);
            $stmt->bindParam(':difficulty', $data['difficulty'], PDO::PARAM_STR);
            $stmt->bindParam(':image_url', $data['image_url'], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateRecipe(array $data) {
        try {
            $sql = 'UPDATE recipes SET name = :name, description = :description, category_id = :category_id, 
                    ingredients = :ingredients, instructions = :instructions, preparation_time = :preparation_time, 
                    cooking_time = :cooking_time, difficulty = :difficulty, image_url = :image_url WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindParam(':ingredients', $data['ingredients'], PDO::PARAM_STR);
            $stmt->bindParam(':instructions', $data['instructions'], PDO::PARAM_STR);
            $stmt->bindParam(':preparation_time', $data['preparation_time'], PDO::PARAM_INT);
            $stmt->bindParam(':cooking_time', $data['cooking_time'], PDO::PARAM_INT);
            $stmt->bindParam(':difficulty', $data['difficulty'], PDO::PARAM_STR);
            $stmt->bindParam(':image_url', $data['image_url'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteRecipe(int $id) {
        try {
            $sql = 'DELETE FROM recipes WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getCategories() {
        try {
            $userId = $_SESSION['user']['id'] ?? 0;
            $sql = 'SELECT id, name FROM categories WHERE user_id = :user_id ORDER BY name ASC';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getRecipesByCategory(int $categoryId, int $userId) {
        try {
            $sql = 'SELECT * FROM recipes WHERE category_id = :category_id AND user_id = :user_id ORDER BY created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
