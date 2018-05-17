<?php 
Loader::loadCommonFunction(['check-login', 'require-admin']);

$orders = Order::getAllOrders();
$users = User::getAllUsers();
$products = Product::getAllProducts();
$ordersProducts = Order::getProductsInOrder();

$g->template
  ->setVars([
    'orders' => $orders,
    'users' => $users,
    'products' => $products,
    'ordersProducts' => $ordersProducts
  ])
  ->renderViews([
    'common/header', 
    'orders/index', 
    'common/footer'
    ]);