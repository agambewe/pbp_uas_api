<?php
$dbServer = "localhost";
$username = "root";
$password = "";
$dbName = "uas_pbp";
$con = mysqli_connect($dbServer,$username,$password,$dbName);
if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ". mysqli_connect_error();
}
?>