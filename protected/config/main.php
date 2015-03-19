<?php

$settings=parse_ini_file('settings.ini');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'POS and Station Reinforcement Timer',

    // Theme
    'theme'=>$settings['theme'],
    
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*', 
        'application.modules.rights.components.*',

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'blank',
        
		),
		*/
        'user',
        'rights'=>array( 'install'=>false), // Enables the installer. ),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
            'class'=>'RWebUser', // Allows super users access implicitly.
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
        */
		// uncomment the following to use a MySQL database
		// Modify this array to use your own server hostname and Database name
        
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname='.$settings['dbname'],
			'emulatePrepare' => true,
			'username' => $settings['dbuser'],
			'password' => $settings['dbpassword'],
			'charset' => 'utf8',
            'tablePrefix'=>$settings['dbprefix'],
		),
		
        'authManager'=>array(
            'class'=>'CPhpAuthManager',
            'class'=>'RDbAuthManager', // Provides support authorization item sorting.
            'defaultRoles'=>array('Guest'),
        ),

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
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
                
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>$settings['adminEmail'],
        'cronjobEmail'=>$settings['cronjobEmail'],
        // define if user must Log In to view POS Timer Info.
        // TRUE = login is required, FALSE = no login required 
        'requireLogin'=>$settings['requireLogin'],
        // define a header message for the main index page
        'indexHeader'=>$settings['indexHeader']
	),
);
