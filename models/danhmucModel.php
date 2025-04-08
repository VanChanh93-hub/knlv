<?php
  require_once "Database.php";


  class Category {
      private $db;
  
      public function __construct() {
          $this->db = new Database;
      }
  
      public function getAll() {
        $sql = "SELECT c.*, COUNT(p.id) as product_count 
                FROM categories c
                LEFT JOIN products p ON c.id = p.id_category
                GROUP BY c.id";
        return $this->db->getAll($sql);
    }
    
  
      public function getById($id) {
          $sql = "SELECT * FROM categories WHERE id = ?";
          return $this->db->getOne($sql, $id);
      }
  
      public function update($id, $name, $image = null) {
        if ($image !== null) {
            $sql = "UPDATE categories SET name = ?, image = ? WHERE id = ?";
            return $this->db->update($sql, $name, $image, $id);
        } else {
            $sql = "UPDATE categories SET name = ? WHERE id = ?";
            return $this->db->update($sql, $name, $id);
        }
    }
    public function existsByName($name, $excludeId = null) {
        $sql = "SELECT COUNT(*) as total FROM categories WHERE name = ?";
        $params = [$name];
    
        if ($excludeId !== null) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
    
        $result = $this->db->getOne($sql, ...$params);
        return $result['total'] > 0;
    }
    
      public function delete($id) {
          $sql = "DELETE FROM categories WHERE id = ?";
          return $this->db->delete($sql, $id);
      }
      public function add($name, $image) {
        $sql = "INSERT INTO categories (name, image) VALUES (?, ?)";
        return $this->db->insert($sql, $name, $image);
    }
    public function countProductsByCategory($categoryId) {
        $sql = "SELECT COUNT(*) as total FROM products WHERE id_category = ?";
        $result = $this->db->getOne($sql, $categoryId);
        return $result['total'] ?? 0;
    }
    
    
    
  }
  

