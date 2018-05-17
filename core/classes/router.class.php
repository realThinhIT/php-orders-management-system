<?php 
class Router {
  public $baseUrl = '';
  public $resource;
  public $action;
  public $resourceId;

  function setBaseUrl($url = '') {
    $this->baseUrl = $url;
  }

  function __construct() {
    // get resource 
    $this->resource = (@$_GET['resource'] != '') ? $_GET['resource'] : 'homepage';
    $this->action   = (@$_GET['action'] != '') ? $_GET['action'] : 'index';
    $this->resourceId = (@$_GET['resourceId'] != '') ? $_GET['resourceId'] : '';
  }

  function handleRoutes() {
    global $g;

    $controllerPath = "{$this->resource}/{$this->action}";
    $controllerPath = str_replace(['..', '.php'], '', $controllerPath); // prevent hacking by browsing dirs

    if (file_exists($ctlPath = APP_DIR . "/controllers/{$controllerPath}.ctl.php")) {
      require($ctlPath);
    } else {
      // throw error page
      $this->resource = 'error';
      $this->action = 'no-route';

      $this->handleRoutes();
    }
  }

  public function url($resource = '', $action = '', $id = '') {
    return "{$this->baseUrl}/?resource={$resource}&action={$action}&resourceId={$id}";
  }

  public function redirect($redirectTo = '') {
    @header("Location: {$redirectTo}");
    echo "<script>window.location.href='{$redirectTo}';</script>";
  }
}