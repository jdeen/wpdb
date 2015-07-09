#!/usr/bin/env php

<?php

/**
 * wpdb is a simple script to configure localhost database with a WordPress
 * installation. This file would create a user and database in localhost
 * for the php config file provided.
 *
 * @category   CategoryName
 * @package    WPDB
 * @author     Ziyan Junaideen <ziyan@jdeen.com>
 * @copyright  JDeen Solutions
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    0.1.0
 */

// Auto loading
require_once('vendor/autoload.php');

// Checking for existing for configuration file. If the file is not present to display
// a message to the user with instructions to create it.
if (!is_readable('config.yaml')){
    die('config.yaml not available. An example can be found at config.yaml.sample');
}

// Loading config
$config = Spyc::YAMLLoad('config.yaml');

// The wp-config.php file path provided by the user and checking for its existence
$file_name = $argv[1];

if (!is_readable($file_name)){
    echo "File $file_name is not readable";
}

// Reading the file to memory
$lines = file($file_name);
$content = '';

// We don't want the first line and last line in the config file (assuming that the config
// file has not been edited).
for ($i = 1; $i < count($lines) - 1; $i++){
    $content = $content . $lines[$i];
}

// Evaluating the file to get the necessary variable for to create the connection
eval($content);

if (DB_HOST != 'localhost'){
    die('Sorry! Only localhost connections are supported!');
}

//
/*
 * TODO Handling the issue of existing databases
 *
 * In this case we could follow the following work flow.
 *
 * - Check if db exists
 * - If DB exists, we do a sql dumb (file name to be hashed with username, password, db name)
 * - We drop the db; drop the user
 * - We create the db; create the user; assign the db;
 * - When the previous wp app is again sent through the ap
 * - We generate hash using username, password, db
 * - Dump the new db with the same procedure
 * - Drop the db; and run the dump;
 * - Continue work
 */

// Connecting to development mysql database
mysql_connect($config['db']['host'], $config['db']['user'], $config['db']['password']);

// Executing sql to create user, create db and assign user to db with full previleges
mysql_query(sprintf("CREATE USER '%s'@'localhost' IDENTIFIED BY '%s';", DB_USER, DB_PASSWORD));
mysql_query(sprintf("CREATE DATABASE %s;", DB_NAME));
mysql_query(sprintf("GRANT ALL ON %s.* TO '%s'@'localhost'", DB_NAME, DB_USER));

// Time to cleanup
mysql_close();

die('Complete! Greetings by JDeen and happy hacking!');