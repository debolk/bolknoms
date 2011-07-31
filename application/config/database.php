<?php defined('SYSPATH') or die('No direct access allowed.');

$configuration = array
(
	'default' => array
	(
		'type'       => 'mysql',
		'connection' => array(
			'hostname'   => 'localhost',
			 //'database'   => '', // Determined dynamically below
			'username'   => 'bolknoms',
			'password'   => 'xisAvurA',
			'persistent' => true,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => true,
		'profiling'    => true,
	),
);

// Determine database name
$db = '';
switch (Kohana::$environment)
{
    case Kohana::DEVELOPMENT:
        $db = 'development'; break;
    case Kohana::TESTING:
        $db = 'testing'; break;
    case Kohana::STAGING:
        $db = 'staging'; break;
    default:
        $db = 'production';
}
$configuration['default']['connection']['database'] = 'bolknoms_'.$db;

// Send configuration
return $configuration;