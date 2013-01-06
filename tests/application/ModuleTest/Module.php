<?php

namespace ModuleTest;

use SimpleAOP\Feature\AopPluginProviderInterface;

class Module implements AopPluginProviderInterface
{
    public function getAopPluginConfig()
    {
        return array(
            'invokables' => array(
                'security_interceptor' => 'ModuleTest\Advice\SecurityInterceptor',
            ),
        );
    }
}