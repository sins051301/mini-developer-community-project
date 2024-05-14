<?php

$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS userdata';

mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'userdata') or die(mysqli_error($db));

$query = 'CREATE TABLE usertable (
    SID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    Login_id VARCHAR(255) NOT NULL, 
    Login_name VARCHAR(255) NOT NULL, 
    Login_pw VARCHAR(255) NOT NULL, 
    Login_email VARCHAR(255) NOT NULL, 
    User_university VARCHAR(255) NOT NULL, 
    Join_date DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (SID)
) 
ENGINE=MyISAM';

mysqli_query($db, $query) or die(mysqli_error($db));
echo 'User database successfully created!';
?>