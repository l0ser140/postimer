<?php

$settings=parse_ini_file('settings.ini'); 

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'POSTimer Console Application',

    'modules'=>array(
        'user',
        'rights'=>array( 'install'=>false), // Enables the installer. ),      
    ),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*', 
        'application.modules.rights.components.*',

    ),    

    'components'=>array(
    
    'db'=>array(
        'connectionString' => 'mysql:host=localhost;dbname='.$settings['dbname'],
        //'connectionString' => 'mysql:host=localhost;dbname=postimer',
        'emulatePrepare' => true,
        'username' => $settings['dbuser'],
        'password' => $settings['dbpassword'],
        'charset' => 'utf8',
        'tablePrefix'=> $settings['dbprefix'],
        ),        
    ),
    
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
