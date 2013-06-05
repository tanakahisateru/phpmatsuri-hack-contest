<?php
/**
 * Copy this file into the same directory and rename it to 'env-devel.php'.
 */

// Set your database settings.
$db = array(
	'connectionString' => 'mysql:host=localhost;dbname=** dbname **;charset=utf8',
	'emulatePrepare' => true,
	'username' => '** user **',
	'password' => '** password **',
	'charset' => 'utf8',
);

// Set MD5ed password for admin user to below.
$systemUserMD5Passwords = array(
	'admin' => '** here **',
);

// Set Twitter API key and secret below.
$twitterAPIKey = array(
	'consumer_key' => '** twitter consumer key **',
	'consumer_secret' => '** twitter consumer secret **',
);
