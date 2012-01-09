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
        $db = 'bolknoms_development'; break;
    case Kohana::TESTING:
        $db = 'bolknoms_testing'; break;
    case Kohana::STAGING:
        $db = 'bolknoms_staging'; break;
    default:
        $db = 'inschrijven';
}
$configuration['default']['connection']['database'] = $db;

// Send configuration
return $configuration;