<?php 
class Loader {
  static public function loadClasses($classes = []) {
    global $g;

    foreach ($classes as $class) {
      if (file_exists($filePath = CORE_DIR . "/classes/{$class}.class.php")) {
        require_once($filePath);
      }
    }
  }

  static public function performActions($actions = []) {
    global $g;
    
    foreach ($actions as $action) {
      if (file_exists($filePath = CORE_DIR . "/actions/{$action}.action.php")) {
        require_once($filePath);
      }
    }
  }

  static public function loadCommonFunction($functions = []) {
    global $g;

    foreach ($functions as $func) {
      if (file_exists($filePath = APP_DIR . "/common/{$func}.func.php")) {
        require_once($filePath);
      }
    }
  }
}