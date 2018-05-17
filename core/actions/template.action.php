<?php
require_once(CONFIG_DIR . '/view.cnf.php');
require_once(CONFIG_DIR . '/app.cnf.php');

$g->template = new Template();
$g->template->setTemplateDirPath(CONFIG_TEMPLATE_DIR_PATH);
$g->template->setVar('root_url', WEB_BASE_URL);