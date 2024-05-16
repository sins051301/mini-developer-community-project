<?php

$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS userdata';

mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'userdata') or die(mysqli_error($db));

$query = 'CREATE TABLE userchattable (
    SID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    User_page_id VARCHAR(255) NOT NULL,
    Login_chat_id VARCHAR(255) NOT NULL,
    Login_chat_category VARCHAR(255) NOT NULL,
    Chat_message VARCHAR(255) NOT NULL, 
    Chat_date DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (SID)
) 
ENGINE=MyISAM';

mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Chat database successfully created!';
?>