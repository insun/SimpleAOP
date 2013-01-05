<?php

namespace SimpleAOPTest\Advice;

use PHPUnit_Framework_TestCase as TestCase;
use SimpleAOP\Aop;
use sample;
use Zend\ServiceManager\ServiceManager;

class AroundTest extends TestCase
{
    protected $aop;
    protected $target;

    public function setUp()
    {
        $this->aop = new Aop();
        $this->aop->setServiceLocator(new ServiceManager());
        $this->target = new sample\Around\Foo();
    }

    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->foo('zend', 'framework');
        $this->assertEquals($result, "zend framework");

        $this->aop->register(new sample\Around\FooAround());
        $result = $this->target->foo('zend', 'framework');
        $this->assertEquals($result, "before intercepted is overrided");
    }
}