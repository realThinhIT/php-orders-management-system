<?php 
if ($g->currentUser) {
  if ($g->currentUser['position'] != 'admin') {
    die("This section requires admin rights!");
  }
}