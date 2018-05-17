<?php 
class Product { 
  public static function getAllProducts() {
    global $g;

    $stmt = $g->db->prepare("
      SELECT * FROM `products`
    ");
    
    if ($stmt->execute()) {
      return $stmt->get_result();
    } else {
      return [];
    }
  }

  public static function getProductById($id) {
    global $g;

    $stmt = $g->db->prepare("
      SELECT * FROM `products`
      WHERE `id` = ?
      LIMIT 1
    ");
    $stmt->bind_param(
      's',
      $productId
    );
    $productId = $id;
    
    if ($stmt->execute()) {
      return $stmt->get_result()->fetch_assoc();
    } else {
      return [];
    }
  }
}