<?php

namespace SimpleAOPTest\Advice\After;

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
        $this->target = new sample\Business\After();
    }

    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->foo();
        $this->assertEquals($result, "foo");

        $this->aop->register(new sample\After\Simple());
        $result = $this->target->foo();
        $this->assertEquals($result, "foo is overrided");
    }

    public function testCanInterceptAndChangeReturnValueInCustomeMethod()
    {
        $result = $this->target->custom();
        $this->assertEquals($result, "custom");

        $this->aop->register(new sample\After\Simple());
        $result = $this->target->custom();
        $this->assertEquals($result, "customisation in progress");
    }
}
