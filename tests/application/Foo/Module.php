<?php

namespace Foo;

use SimpleAOP\Feature\AopPluginProviderInterface;

class Module implements AopPluginProviderInterface
{
    public function getAopPluginConfig()
    {
        return array(
            'invokables' => array(
                'security_interceptor' => 'Foo\Advice\SecurityInterceptor',
            ),
        );
    }
}