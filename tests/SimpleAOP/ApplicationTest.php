<?php

namespace SimpleAOPTest\Advice;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Mvc\Application;

class ApplicationTest extends TestCase
{
    public function testCanRunModule()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.php');
        $serviceLocator = $application->getServiceManager();
        $advicePluginManager = $serviceLocator->get('AdvicePluginManager');
        $securityInterceptor = $advicePluginManager->get('security_interceptor');
        $this->assertEquals('ModuleTest\Advice\SecurityInterceptor', get_class($securityInterceptor));

        $aop = $serviceLocator->get('aop');
        $this->assertEquals('SimpleAOP\Aop', get_class($aop));

        $aop = $serviceLocator->get('simple_aop');
        $this->assertEquals('SimpleAOP\Aop', get_class($aop));

        $aop->register('security_interceptor');
        $aop->register($securityInterceptor);

        $this->setExpectedException('Zend\ServiceManager\Exception\ServiceNotFoundException');
        $aop->register('unknow_advice');
    }
}
