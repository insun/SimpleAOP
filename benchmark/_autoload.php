<?php

require_once ZF2_PATH . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'FirstUseCase' => __DIR__ . '/FirstUseCase/src/FirstUseCase',
            'SecondUseCase' => __DIR__ . '/SecondUseCase/src/SecondUseCase',
            'SimpleAOP' => __DIR__ . '/../src/SimpleAOP',
        ),
    ),
));
