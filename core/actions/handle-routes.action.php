<?php 
require_once(CONFIG_DIR . '/app.cnf.php');

$g->router = new Router();
$g->router->setBaseUrl(WEB_BASE_URL);
$g->router->handleRoutes();