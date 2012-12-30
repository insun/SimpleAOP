<?php

require_once DIR_ZF2 . 'Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'SimpleAOP' => __DIR__ . '/../src/SimpleAOP',
            'SimpleAOPTest' => __DIR__ . '/SimpleAOP',
        ),
    ),
));