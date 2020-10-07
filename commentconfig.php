<?php
define('commentDB_SERVER', 'localhost');
define('commentDB_USERNAME', 'root');
define('commentDB_PASSWORD', '');
define('commentDB_NAME', 'commentDB');

$commentlink = mysqli_connect(commentDB_SERVER, commentDB_USERNAME, commentDB_PASSWORD, commentDB_NAME);

if($commentlink === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
