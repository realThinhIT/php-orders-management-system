<?php 
class Template {
  private $templateDirPath = '';
  private $renderVariables = [];

  public function setTemplateDirPath($path) {
    if ($path) {
      $this->templateDirPath = $path;
    }
  }

  public function setVar($varName = '', $value = '') {
    if ($varName) {
      try {
        $this->renderVariables[$varName] = $value;
      } catch (Exception $e) {}
    }

    return $this;
  }

  public function setVars($vars = []) {
    foreach ($vars as $varName => $value) {
      if ($varName) {
        try {
          $this->renderVariables[$varName] = $value;
        } catch (Exception $e) {}
      }
    }

    return $this;
  }

  public function renderViews($views = []) {
    global $g;

    $this->renderVariables['g'] = $g;
    @extract($this->renderVariables);

    foreach ($views as $view) {
      if ($view && file_exists($filePath = "{$this->templateDirPath}/{$view}.view.php")) {
        include($filePath);
      }
    }

    return $this;
  }

  public function windowAlert($msg = '') {
    if ($msg) {
      echo "<script>window.alert('{$msg}');</script>";
    }
  }
}