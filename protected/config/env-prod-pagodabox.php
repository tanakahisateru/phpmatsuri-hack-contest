<?php
$db = array(
	'connectionString' => sprintf('mysql:host=%s:%d;dbname=%s',
		$_SERVER["DB1_HOST"], $_SERVER["DB1_PORT"], $_SERVER["DB1_NAME"]),
	'emulatePrepare' => true,
	'username' => $_SERVER["DB1_USER"],
	'password' => $_SERVER["DB1_PASS"],
	'charset' => 'utf8',
);

$systemUserMD5Passwords = array(
	'admin' => $_ENV['ADMIN_PASSWORD_MD5'],
);

$twitterAPIKey = array(
	'consumer_key' => $_ENV['TWITTER_CONSUMER_KEY'],
	'consumer_secret' => $_ENV['TWITTER_CONSUMER_SECRET'],
);
