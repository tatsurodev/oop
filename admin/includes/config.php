<?php

// Database Connection Constants

define('DB_HOST', 'mysql');
define('DB_USER', 'docker');
define('DB_PASS', 'docker');
define('DB_NAME', 'docker');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connection) {
    echo 'true';
}
