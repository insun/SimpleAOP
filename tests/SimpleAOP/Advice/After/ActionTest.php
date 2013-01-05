<?php

namespace SimpleAOPTest\Advice\After;

use PHPUnit_Framework_TestCase as TestCase;
use SimpleAOP\Aop;
use sample;
use Zend\ServiceManager\ServiceManager;

class ActionTest extends TestCase
{
    protected $aop;
    protected $target;

    public function setUp()
    {
        $this->aop = new Aop();
        $this->aop->setServiceLocator(new ServiceManager());
        $this->target = new sample\After\Foo();
    }

    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->fooAction();
        $this->assertEquals($result, array('attr' => 'foo'));

        $this->aop->register(new sample\After\ActionFoo());
        $result = $this->target->fooAction();
        $this->assertEquals($result, "foo is overrided");
    }

    public function testCanInterceptAndChangeReturnValueInCustomeMethod()
    {
        $result = $this->target->customAction();
        $this->assertEquals($result, array('attr' => 'custom'));

        $this->aop->register(new sample\After\ActionFoo());
        $result = $this->target->customAction();
        $this->assertEquals($result, "customisation in progress");
    }
}
