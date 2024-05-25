<?php

$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS userdata';

mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'userdata') or die(mysqli_error($db));

$query = 'CREATE TABLE tostudytable (
    SID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    Login_study_id VARCHAR(255) NOT NULL,
    Study_id INTEGER UNSIGNED NOT NULL, 
    User_category VARCHAR(255) NOT NULL,
    User_content VARCHAR(255) NOT NULL, 
    User_summary VARCHAR(255) NOT NULL, 
    Create_date DATETIME NOT NULL DEFAULT NOW(),
    Image LONGBLOB NOT NULL,
    PRIMARY KEY (SID)
) 
ENGINE=MyISAM';

mysqli_query($db, $query) or die(mysqli_error($db));
echo 'Tostudy database successfully created!';
?>