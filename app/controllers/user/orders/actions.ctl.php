<?php 
Loader::loadCommonFunction(['check-login', 'require-user']);

if (($rsId = $g->router->resourceId) != '') {
  if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
      CommonModel::deleteResource('order_items', 'order_id', $rsId);
    } catch (Exception $e) {}

    echo CommonModel::deleteResource('orders', 'id', $rsId);
  }
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $_POST['created_at'] = date('Y-m-d G:i:s');
    if ($newRs = CommonModel::createResource('orders', $_POST, ['user_id', 'created_at'])) {
      try {
        foreach (@$_POST['products'] as $k => $v) {
          CommonModel::createResource('order_items', [
            'order_id' => $newRs,
            'product_id' => $v,
            'quantity' => @$_POST['quantities'][$k],
          ], ['order_id', 'product_id', 'quantity', 'created_at']);
        }
      } catch (Exception $e) {}

      echo $newRs;
    } else {
      echo "Cập nhật thất bại do lỗi server, xin thử lại!";
    }
  }
}