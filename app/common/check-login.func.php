<?php 
// if logged in
if (
  @$_SESSION['logged_in_user_id']
  && is_integer($_SESSION['logged_in_user_id'])
  ) {
  $g->currentUser = User::getUserById($_SESSION['logged_in_user_id']);

  if (!$g->currentUser) {
    header("Location: " . $g->router->url('xac-thuc', 'login'));
  }
} else {
  if ($g->router->resource != 'homepage') {
    header("Location: " . $g->router->url('xac-thuc', 'login'));
  }
}