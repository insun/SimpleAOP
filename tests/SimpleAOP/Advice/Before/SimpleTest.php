<?php

namespace SimpleAOPTest\Advice\Before;

use PHPUnit_Framework_TestCase as TestCase;
use SimpleAOP\Aop;
use sample;
use Zend\ServiceManager\ServiceManager;

class SimpleTest extends TestCase
{
    protected $aop;
    protected $target;

    public function setUp()
    {
        $this->aop = new Aop();
        $this->aop->setServiceLocator(new ServiceManager());
        $this->target = new sample\Before\Foo();
    }

    public function testCanInterceptAndSetArguments()
    {
        $result = $this->target->foo('zend', 'framework');
        $this->assertEquals($result, 'zend framework');

        $this->aop->register(new sample\Before\SimpleFooBefore());
        $result = $this->target->foo('zend', 'framework');
        $this->assertEquals($result, 'before intercepted');
    }
}
