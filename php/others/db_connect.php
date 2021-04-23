<?php

define('DSN', 'mysql:dbname=db_shop;host=localhost;charset=utf8');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');

function db_connect() {
    $dbh = new PDO (DSN, DB_USERNAME, DB_PASSWORD);
    // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

?>