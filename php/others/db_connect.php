<?php

define('DSN', 'mysql:dbname=db_shop;host=localhost;charset=utf8');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');

function db_connect() {
    $dbh = new PDO (DSN, DB_USERNAME, DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
    return $dbh;
}

?>