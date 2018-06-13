<?php 
Loader::loadCommonFunction(['check-login', 'require-admin']);

$products = Product::getAllProducts();

$g->template
  ->setVars([
    'products' => $products
  ])
  ->renderViews([
    'common/header', 
    'products/index', 
    'common/footer'
    ]);