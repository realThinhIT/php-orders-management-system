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
}