<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
    'default' => array
    (
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => 'localhost',
            'database'   => 'bolknoms_development',
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
