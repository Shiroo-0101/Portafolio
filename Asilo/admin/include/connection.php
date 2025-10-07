<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Info2024/*-";
$dbname = "oahmsdb";

$conn = mysqli_connect($dbhost , $dbuser , $dbpass , $dbname);

if(!isset($conn)){
    echo die("Database connection failed");
}
?>