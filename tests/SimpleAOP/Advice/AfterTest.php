<?php

namespace SimpleAOPTest\Advice\After;

use PHPUnit_Framework_TestCase as TestCase;
use SimpleAOP\Aop;
use mock;

class AfterTest extends TestCase
{
    protected $aop;
    protected $target;
    
    public function setUp()
    {
        $this->aop = new Aop();
        $this->target = new mock\After\Foo();
    }
    
    public function testCanNotifiedAfter()
    {
        $result = $this->target->foo();
        $this->assertEquals($result, "foo");
        
        $this->aop->register(new mock\After\FooAfter());
        $result = $this->target->foo();
        $this->assertEquals($result, "bar");
    }
}