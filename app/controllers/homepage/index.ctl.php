<?php
// header("Location: " . $g->router->url('xac-thuc', 'login'));

Loader::loadCommonFunction(['check-login']);

$g->template->renderViews([
  'common/header', 
  'homepage/index', 
  'common/footer'
  ]);