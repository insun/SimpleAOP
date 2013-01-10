<?php

namespace FirstUseCase;

use SimpleAOP\Feature\AopAspectProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AopAspectProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        $aop = array();
        if(AOP_ENABLE && !defined('AOP_ALREADY_INIT')) {
            $aop = array(
                'before_aspect',
                'after_aspect',
            );
        }
        
        return array(
            'aop' => $aop,
            'console' => array(
                'router' => array(
                    'routes' => array(
                        'tests' => array(
                            'type' => 'simple',
                            'options' => array(
                                'route' => '--tests',
                                'defaults' => array(
                                    'controller' => 'test_test',
                                    'action'     => 'test',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'controllers' => array(
                'invokables' => array(
                    'test_test' => 'FirstUseCase\Controller\TestController',
                ),
            ),
        );
    }

    public function getAopAspectConfig()
    {
        return array(
            'invokables' => array(
                'before_aspect' => 'FirstUseCase\Aspect\After',
                'after_aspect' => 'FirstUseCase\Aspect\Before',
            ),
        );
    }
}
