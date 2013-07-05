<?php
if (isset($_ENV['PLATFORM']) && $_ENV['PLATFORM'] == 'pagodabox') {
	require dirname(__FILE__) . '/env-prod-pagodabox.php';
}
else {
	require dirname(__FILE__) . '/env-devel.php';
}

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'PHPMatsuri',

	'language'=>'ja',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
				'bootstrap.gii'
			),
		),
		'admin',
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('site/twitterLogin'),
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				//'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'/admin/<controller:\w+>/<action:\w+>' => '/admin/<controller>/<action>',
				'/<controller:\w+>/<action:\w+>/<id:\d+>'=>'/<controller>/<action>',
				'/<controller:\w+>/<action:\w+>'=>'/<controller>/<action>',
			),
			'showScriptName'=>false,
		),
		'db'=>$db,
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CWebLogRoute',
					'enabled'=>false,
				),
			),
		),
		'widgetFactory'=>array(
			'widgets'=>array(
				'TbListView'=>array(
					//'enableHistory'=>true, // pjax on
					'ajaxUpdate'=>false, // ajax off
				),
				'TbGridView'=>array(
					'enableHistory'=>true, // pjax on
					'ajaxUpdate'=>true, // ajax on
				),
			),
		),
		'bootstrap' => array(
			'class' => 'ext.bootstrap.components.Bootstrap',
			'responsiveCss' => true,
		),
		'twitter' => array(
			'class' => 'ext.yiitwitteroauth.YiiTwitter',
			'consumer_key' => $twitterAPIKey['consumer_key'],
			'consumer_secret' => $twitterAPIKey['consumer_secret'],
			'callback' => null,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'systemUserMD5Passwords' => $systemUserMD5Passwords,
		'htmlPurifierOptions' => array(
			'HTML.SafeIframe' => true,
			'URI.SafeIframeRegexp' => '%^http://%',
		),
	),
);