<?php

$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS userdata';

mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'userdata') or die(mysqli_error($db));

$query = 'CREATE TABLE todotable (
    SID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    Login_todo_id VARCHAR(255) NOT NULL, 
    User_task VARCHAR(255) NOT NULL, 
    Create_date DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (SID)
) 
ENGINE=MyISAM';

mysqli_query($db, $query) or die(mysqli_error($db));
echo 'Todo database successfully created!';
?>