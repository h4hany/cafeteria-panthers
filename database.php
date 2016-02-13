<?php


define('DB_NAME', 'iti_cafeteria');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db_selected = mysqli_select_db($connection, DB_NAME);
if (!$db_selected) {
    die('Can\'t use ' . DB_NAME . ' : ' . mysqli_connect_error());
}