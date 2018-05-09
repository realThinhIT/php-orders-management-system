<?php
require_once(CONFIG_DIR . '/database.cnf.php');
$g->db = new Connection(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASS, CONFIG_DB_DBNAME);

if ($g->db->connect_error) {
  die('ERROR: Could connect to the database.');
}