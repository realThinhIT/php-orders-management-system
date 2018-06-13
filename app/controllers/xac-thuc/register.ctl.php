<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST)) {
    if ($user = User::createNewUser($_POST)) {
      $g->template->windowAlert('Đăng kí tài khoản thành công!');
      $g->router->redirect($g->router->url('xac-thuc', 'login'));
    } else {
      $g->template->windowAlert('Đăng kí tài khoản thất bại, xin thử lại!');
    }
  }
}

$g->template->renderViews([
  'common/header', 
  'login/register', 
  'common/footer'
  ]);