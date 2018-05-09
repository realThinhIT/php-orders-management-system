<?php 
error_reporting(E_ALL); ini_set('display_errors', 1);

// define absolute paths to root & relative folder
define('ROOT_DIR',    dirname(__FILE__));
define('CONFIG_DIR',  ROOT_DIR . '/config');
define('CORE_DIR',    ROOT_DIR . '/core');
define('APP_DIR',     ROOT_DIR . '/app');

// initialize the app
require_once(CORE_DIR . '/init.php');