<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'batman31';
$db = 'accounts';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
