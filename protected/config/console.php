<?php
if (isset($_ENV['PLATFORM']) && $_ENV['PLATFORM'] == 'pagodabox') {
	require dirname(__FILE__) . '/env-prod-pagodabox.php';
}
else {
	require dirname(__FILE__) . '/env-devel.php';
}

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		'db'=>$db,
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);