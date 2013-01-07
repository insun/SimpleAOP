<?php

namespace ModuleTest;

use SimpleAOP\Feature\AopAspectProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AopAspectProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        return array(
            'aop' => array(
                'security_interceptor',
            ),
        );
    }

    public function getAopAspectConfig()
    {
        return array(
            'invokables' => array(
                'security_interceptor' => 'ModuleTest\Aspect\SecurityInterceptor',
            ),
        );
    }
}
