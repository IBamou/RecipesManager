<?php
require_once __DIR__ . "/../Configs/Database.php";

class FavoriteModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function addFavorite(int $userId, int $recipeId): bool {
        try {
            $sql = 'INSERT INTO favorites (user_id, recipe_id) VALUES (:user_id, :recipe_id)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':recipe_id', $recipeId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function removeFavorite(int $userId, int $recipeId): bool {
        try {
            $sql = 'DELETE FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':recipe_id', $recipeId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function isFavorited(int $userId, int $recipeId): bool {
        try {
            $sql = 'SELECT id FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':recipe_id', $recipeId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getUserFavorites(int $userId): array {
        try {
            $sql = 'SELECT recipes.*, categories.name as category_name, favorites.created_at as favorited_at
                    FROM favorites
                    INNER JOIN recipes ON favorites.recipe_id = recipes.id
                    LEFT JOIN categories ON recipes.category_id = categories.id
                    WHERE favorites.user_id = :user_id
                    ORDER BY favorites.created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getFavoriteIds(int $userId): array {
        try {
            $sql = 'SELECT recipe_id FROM favorites WHERE user_id = :user_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function countByUser(int $userId): int {
        try {
            $sql = 'SELECT COUNT(*) as count FROM favorites WHERE user_id = :user_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        } catch (PDOException $e) {
            return 0;
        }
    }
}
