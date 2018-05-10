<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST)) {
    if ($user = User::verifyUserByUsernameAndPassword($_POST['email'], $_POST['password'])) {
      $g->router->redirect($g->router->url('admin/products'));
    } else {
      $g->template->windowAlert('Sai tên đăng nhập hoặc mật khẩu, vui lòng thử lại!');
    }
  }
}

$g->template->renderViews([
  'common/header', 
  'login/login', 
  'common/footer'
  ]);