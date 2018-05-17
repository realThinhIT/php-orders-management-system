<?php 
class Order {
  public static function getAllOrders() {
    global $g;

    $stmt = $g->db->prepare("
      SELECT 
        o.*,
        o.id as oid,
        o.created_at as ocreated_at,
        oi.*,
        oi.id as oiid,
        p.*,
        p.id as pid,
        u.*,
        u.name as user_name,
        u.id as uid,
        SUM(p.price * oi.quantity) as sum_price,
        SUM(oi.quantity) as sum_quantity,
        COUNT(product_id) as count_products 
      FROM orders as o

      INNER JOIN
        order_items as oi
          ON o.id = oi.order_id

      LEFT JOIN 
        products as p
        ON p.id = oi.product_id

      LEFT JOIN
        users as u
        ON o.user_id = u.id

      GROUP BY oi.order_id
    ");
    
    if ($stmt->execute()) {
      return $stmt->get_result();
    } else {
      return [];
    }
  }

  public static function getProductsInOrder() {
    global $g;

    $stmt = $g->db->prepare("
      SELECT 
        o.*,
        o.id as oid,
        o.created_at as ocreated_at,
        oi.*,
        oi.id as oiid,
        p.*,
        p.id as pid,
        p.name as pname,
        u.*,
        u.name as user_name,
        u.id as uid,
        (p.price * oi.quantity) as sum_price
      FROM orders as o

      INNER JOIN
        order_items as oi
          ON o.id = oi.order_id

      LEFT JOIN 
        products as p
        ON p.id = oi.product_id

      LEFT JOIN
        users as u
        ON o.user_id = u.id
    ");
    
    if ($stmt->execute()) {
      return $stmt->get_result();
    } else {
      return [];
    }
  }
}