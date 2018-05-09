<?php 
$g = new stdClass();
require_once(CORE_DIR . '/classes/load.class.php');

/**
 * LOAD NECESSARY LIBRARIES
 */
Loader::loadClasses([
  'connection',
  'load',
  'router',
  'template'
]);

/**
 * INIT INSTANCES
 */
Loader::performActions([
  'connect-db',
  'template',
  'handle-routes'
]);