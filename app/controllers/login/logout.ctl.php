<?php
@session_destroy();
header("Location: " . $g->router->url('login', 'login'));