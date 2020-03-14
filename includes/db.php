<?php
define('HOSTNAME', 'localhost');
define('USERNMAE', 'root');
define('PASSWORD', '');
define('DATABASE_NAME', 'kufa');

$db_connect = mysqli_connect(HOSTNAME, USERNMAE, PASSWORD, DATABASE_NAME);

?>