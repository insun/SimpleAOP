<?php

namespace SimpleAOPTest\Aspect;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Mvc\Application;

class ApplicationTest extends TestCase
{
    public function testCanRunModuleWithoutAspect()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.empty.php');
        $serviceLocator = $application->getServiceManager();
        $aspectPluginManager = $serviceLocator->get('AspectPluginManager');

        $this->setExpectedException('Zend\ServiceManager\Exception\ServiceNotFoundException');
        $securityInterceptor = $aspectPluginManager->get('security_interceptor');
    }

    public function testCanRunModuleAndRegisterAspect()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.php');
        $serviceLocator = $application->getServiceManager();
        $aspectPluginManager = $serviceLocator->get('AspectPluginManager');
        $securityInterceptor = $aspectPluginManager->get('security_interceptor');
        $this->assertEquals('ModuleTest\Aspect\SecurityInterceptor', get_class($securityInterceptor));

        $aop = $serviceLocator->get('aop');
        $this->assertEquals('SimpleAOP\Aop', get_class($aop));

        $aop = $serviceLocator->get('simple_aop');
        $this->assertEquals('SimpleAOP\Aop', get_class($aop));

        $aop->register('security_interceptor');
        $aop->register($securityInterceptor);
    }

    public function testCanNotRegisterBadAspect()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.php');
        $serviceLocator = $application->getServiceManager();
        $aop = $serviceLocator->get('aop');

        $this->setExpectedException('SimpleAOP\Exception\InvalidAspectException');
        $aop->register(new \stdClass());
    }

    public function testCanNotRegisterAspectNotTyped()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.php');
        $serviceLocator = $application->getServiceManager();
        $aop = $serviceLocator->get('aop');

        $this->setExpectedException('SimpleAOP\Exception\InvalidAspectException');
        $aop->register(new Custom\BadInterfaced());
    }

    public function testCanNotRegisterBadspectWithAdvicePluginManager()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.php');
        $serviceLocator = $application->getServiceManager();
        $aspectPluginManager = $serviceLocator->get('AspectPluginManager');

        $this->setExpectedException('SimpleAOP\Exception\InvalidAspectException');
        $aspectPluginManager->setInvokableClass('bad_aspect', 'SimpleAOPTest\Aspect\Custom\BadSimple');
        $aspectPluginManager->get('bad_aspect');
    }

    public function testCanNotRegisterIdentifierBadspect()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.php');
        $serviceLocator = $application->getServiceManager();
        $aop = $serviceLocator->get('aop');

        $this->setExpectedException('Zend\ServiceManager\Exception\ServiceNotFoundException');
        $aop->register('unknow_aspect');
    }
}
