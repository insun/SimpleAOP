<?php
return array(
    'modules' => array(
        'SimpleAOP',
    ),
    'module_listener_options' => array(
        'config_cache_enabled' => false,
        'module_paths'         => array(
            'FirstUseCase' => __DIR__ . '/FirstUseCase/',
            'SecondUseCase' => __DIR__ . '/SecondUseCase/',
            'SimpleAOP' => __DIR__ . '/../',
        ),
    ),
    'service_listener_options' => array(
        array(
            'service_manager' => 'AspectPluginManager',
            'config_key' => 'aop_aspects',
            'interface' => 'SimpleAOP\Feature\AopAspectProviderInterface',
            'method' => 'getAopAspectConfig',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'AspectPluginManager' => 'SimpleAOP\AspectPluginManager',
        ),
    ),
);
