<?php
@session_destroy();
header("Location: " . $g->router->url('xac-thuc', 'login'));