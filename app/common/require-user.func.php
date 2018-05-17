<?php 
if ($g->currentUser) {
  if ($g->currentUser['position'] != 'user') {
    die("This section requires user rights!");
  }
} 