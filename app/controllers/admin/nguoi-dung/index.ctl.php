<?php 
Loader::loadCommonFunction(['check-login', 'require-admin']);

$users = User::getAllUsers();

$g->template
  ->setVars([
    'users' => $users
  ])
  ->renderViews([
    'common/header', 
    'users/index', 
    'common/footer'
    ]);