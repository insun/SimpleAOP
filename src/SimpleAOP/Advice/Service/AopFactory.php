<?php

namespace SimpleAOP\Service;

use SimpleAOP\Aop;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AopFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $aop = new Aop();
        $config = $serviceLocator->get('Config');
        if(!isset($config['aop'])) {
            return $aop;
        }
        foreach($config['aop'] as $selector => $advice) {
            $aop->register($selector, $advice);
        }
        return $aop;
    }
}