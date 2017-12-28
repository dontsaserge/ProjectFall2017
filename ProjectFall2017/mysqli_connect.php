<?php

define("db_host", "localhost");
define("db_user", "root");
define("db_password", "" );
define("db_name", "fall_2017_project");

$dbc=mysqli_connect(db_host, db_user, db_password, db_name) or die("Could not be conect".mysqli_connect_error());

mysqli_set_charset($dbc, 'utf8');

?>