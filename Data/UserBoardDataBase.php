<?php

$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS userdata';

mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'userdata') or die(mysqli_error($db));

$query = 'CREATE TABLE userboardtable (
    SID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    Login_board_id VARCHAR(255) NOT NULL, 
    Board_category VARCHAR(255) NOT NULL, 
    Create_board_date DATETIME NOT NULL,
    Board_chat INTEGER UNSIGNED DEFAULT 0,
    Board_thumb INTEGER UNSIGNED DEFAULT 0,
    Board_view INTEGER UNSIGNED DEFAULT 0,
    PRIMARY KEY (SID)
) 
ENGINE=MyISAM';

mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Board database successfully created!';
?>