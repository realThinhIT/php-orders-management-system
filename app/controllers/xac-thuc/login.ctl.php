<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST)) {
    if (
        ($user = User::verifyUserByUsernameAndPassword($_POST['email'], $_POST['password']))
        && $user > 0
      ) {
      // login successfully
      $_SESSION['logged_in_user_id'] = $user;

      $user = User::getUserById(@$_SESSION['logged_in_user_id']);
      $g->router->redirect($g->router->url($user['position'] . '/don-hang'));
    } else {
      $g->template->windowAlert('Sai tên đăng nhập hoặc mật khẩu, vui lòng thử lại!');
    }
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (@$_SESSION['logged_in_user_id']) {
    $user = User::getUserById(@$_SESSION['logged_in_user_id']);
    $g->router->redirect($g->router->url($user['position'] . '/don-hang'));
    die;
  }
}

$g->router->redirect($g->router->url('homepage'));
$g->template->renderViews([
  'common/header', 
  'login/login', 
  'common/footer'
  ]);