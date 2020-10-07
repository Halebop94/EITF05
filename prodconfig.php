<?php
define('prodDB_SERVER', 'localhost');
define('prodDB_USERNAME', 'root');
define('prodDB_PASSWORD', '');
define('prodDB_NAME', 'prodDB');

$prodlink = mysqli_connect(prodDB_SERVER, prodDB_USERNAME, prodDB_PASSWORD, prodDB_NAME);

if($prodlink === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
