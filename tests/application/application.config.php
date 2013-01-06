<?php
return array(
    'modules' => array(
        'ModuleTest',
        'SimpleAOP',
    ),
    'module_listener_options' => array(
        'config_cache_enabled' => false,
        'module_paths'         => array(
            'ModuleTest' => __DIR__ . '/ModuleTest/',
            'SimpleAOP' => __DIR__ . '/../../',
        ),
    ),
    'service_listener_options' => array(
        array(
            'service_manager' => 'AdvicePluginManager',
            'config_key' => 'aop_plugins',
            'interface' => 'SimpleAOP\Feature\AopPluginProviderInterface',
            'method' => 'getAopPluginConfig',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'AdvicePluginManager' => 'SimpleAOP\AdvicePluginManager',
        ),
    ),
);