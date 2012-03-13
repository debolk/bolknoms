<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Amsterdam');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale (LC_ALL, 'nl_NL','nl', 'du', 'dutch');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
    'index_file' => '',
    'caching'    => (Kohana::$environment === Kohana::PRODUCTION),
    'profile'    => (Kohana::$environment !== Kohana::PRODUCTION),
	'errors'	 => true
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
$modules = array(
    'database'   => MODPATH.'database',   // Database access
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	'flash'      => MODPATH.'flash',      // Flash messages
);
// Enable unittesting, except on production
if (Kohana::$environment !== Kohana::PRODUCTION) {
    $modules['unittest'] = MODPATH.'unittest';
}
Kohana::modules($modules);

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('inschrijven', 'inschrijven')
	->defaults(array(
		'controller' => 'front',
		'action'     => 'index',
	));
Route::set('uitgebreid-inschrijven', 'uitgebreid-inschrijven')
	->defaults(array(
		'controller' => 'front',
		'action'     => 'uitgebreidinschrijven',
	));
Route::set('uitgebreidaanmelden', 'uitgebreidaanmelden')
	->defaults(array(
		'controller' => 'front',
		'action'     => 'uitgebreidaanmelden',
	));
Route::set('aanmelden', 'aanmelden')
	->defaults(array(
		'controller' => 'front',
		'action'     => 'aanmelden',
	));
Route::set('afmelden', 'afmelden/<id>/<salt>', array('id' => '\d+', 'salt' => '\w+'))
	->defaults(array(
		'controller' => 'front',
		'action'     => 'afmelden',
	));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'front',
		'action'     => 'index',
	));

Route::set('error', 'error/<action>', array('action' => '[0-9]++'))
->defaults(array(
	'controller' => 'error'
));
