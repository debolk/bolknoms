<?php defined('SYSPATH') or die('No direct access allowed.');

/*
 * Configuration for the testing-environment of Kohana
 */
return array
(
	'database' => array(
        'default' => array
        (
            'type'       => 'mysql',
            'connection' => array(
                'hostname'   => 'localhost',
                'database'   => 'bolknoms_test',
                'username'   => 'bolknoms',
                'password'   => 'xisAvurA',
                'persistent' => true,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => true,
            'profiling'    => true,
        )
    )
);