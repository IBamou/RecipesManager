<?php
require_once __DIR__ . "/../Configs/Database.php";

class CategoryModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function getCategories() {
        try {
            $sql = 'SELECT * FROM categories ORDER BY created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getCategoriesByUser(int $userId) {
        try {
            $sql = 'SELECT c.*, COUNT(r.id) as recipe_count 
                    FROM categories c 
                    LEFT JOIN recipes r ON c.id = r.category_id 
                    WHERE c.user_id = :user_id 
                    GROUP BY c.id 
                    ORDER BY c.created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getCategoryById(int $id) {
        try {
            $sql = 'SELECT * FROM categories WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function storeCategory(array $data) {
        try {
            $sql = 'INSERT INTO categories (name, description, user_id) VALUES (:name, :description, :user_id)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateCategory(array $data) {
        try {
            $sql = 'UPDATE categories SET name = :name, description = :description WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteCategory(int $id) {
        try {
            $sql = 'DELETE FROM categories WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function countByUser(int $userId): int {
        try {
            $sql = 'SELECT COUNT(*) as count FROM categories WHERE user_id = :user_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        } catch (PDOException $e) {
            return 0;
        }
    }
}
