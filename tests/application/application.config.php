<?php
return array(
    'modules' => array(
        'Foo',
        'SimpleAOP',
    ),
    'module_listener_options' => array(
        'config_cache_enabled' => false,
        'module_paths'         => array(
            'Foo' => __DIR__ . '/Foo/',
            'SimpleAOP' => __DIR__ . '../../../SimpleAOP',
        ),
    ),
);