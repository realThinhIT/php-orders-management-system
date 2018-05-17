<?php 
Loader::loadCommonFunction(['check-login', 'require-admin']);

if (($rsId = (int) $g->router->resourceId) != '') {
  if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo CommonModel::deleteResource('products', 'id', $rsId);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postPrice = floatval(str_replace(',', '', @$_POST['price']));

    if (is_double($postPrice)) {
      $_POST['price'] = $postPrice;
    }

    echo CommonModel::modifyResource('products', $rsId, $_POST, [
      'name',
      'price',
      'sku',
      'stock',
      'image_url' 
    ]);
  }
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if (@$_POST['price'] == '') {
      echo 'Giá sản phẩm không được bỏ trống!';
      exit;
    } else {
      $postPrice = floatval(str_replace(',', '', $_POST['price']));

      if (is_double($postPrice)) {
        $_POST['price'] = $postPrice;
      }
    }

    if ($newRs = CommonModel::createResource('products', $_POST, ['name', 'price', 'sku', 'stock', 'image_url'])) {
      echo $newRs;
    } else {
      echo "Cập nhật thất bại do lỗi server, xin thử lại!";
    }
  }
}