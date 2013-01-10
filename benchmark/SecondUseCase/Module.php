<?php

namespace SecondUseCase;

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
                'unused_1',
                'unused_2',
                'unused_3',
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
                    'test_test' => 'SecondUseCase\Controller\TestController',
                ),
            ),
        );
    }

    public function getAopAspectConfig()
    {
        return array(
            'invokables' => array(
                'before_aspect' => 'SecondUseCase\Aspect\After',
                'after_aspect' => 'SecondUseCase\Aspect\Before',
                'unused_1' => 'SecondUseCase\Aspect\UnUsed1',
                'unused_2' => 'SecondUseCase\Aspect\UnUsed2',
                'unused_3' => 'SecondUseCase\Aspect\UnUsed3',
            ),
        );
    }
}
