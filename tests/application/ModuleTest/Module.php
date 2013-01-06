<?php

namespace ModuleTest;

use SimpleAOP\Feature\AopAspectProviderInterface;

class Module implements AopAspectProviderInterface
{
    public function getAopAspectConfig()
    {
        return array(
            'invokables' => array(
                'security_interceptor' => 'ModuleTest\Aspect\SecurityInterceptor',
            ),
        );
    }
}