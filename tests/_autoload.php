<?php

require_once __DIR__ . '/../../zf2-fork/library/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'sample' => __DIR__ . '/_files',
            'SimpleAOP' => __DIR__ . '/../src/SimpleAOP',
            'SimpleAOPTest' => __DIR__ . '/SimpleAOP',
        ),
    ),
));