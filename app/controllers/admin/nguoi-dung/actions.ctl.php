<?php 
Loader::loadCommonFunction(['check-login', 'require-admin']);

if (($rsId = $g->router->resourceId) != '') {
  if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo CommonModel::deleteResource('users', 'id', $rsId);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo CommonModel::modifyResource('users', $rsId, $_POST, [
      'username',
      'email',
      'name',
      'telephone_number',
      'address'
    ]);
  }
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if ($newRs = CommonModel::createResource('users', $_POST, ['name', 'email', 'username', 'telephone_number', 'address', 'position'])) {
      echo $newRs;
    } else {
      echo "Cập nhật thất bại do lỗi server, xin thử lại!";
    }
  }
}