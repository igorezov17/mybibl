<?php

// это твой конфиг сайта
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		// asd123 <<
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'asd123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			// 'ipFilters'=>array('127.0.0.1','::1'),
			'ipFilters'=>array('10.192.160.19','::1'),
		),
		
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => true,
			'rules'=>array(
				'gii' => 'gii',
				'gii/<_c:\w+>' => 'gii/<_c>',
				'gii/<_c:\w+>/<_a:\w+>' => 'gii/<_c>/<_a>',

				'<action:\w+>'=>'site/<action>',
				'<action:\w+>/<id:\d+>'=>'site/<action>',
				'<action:\w+>/<id:\d+>/<param:\w+>'=>'site/<action>',
				'<action:\w+>/<param:\w+>'=>'site/<action>'
			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
