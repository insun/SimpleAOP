<?php

namespace SimpleAOPTest\Aspect;

use sample;

class AfterTest extends AbstractAspectTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->mirror("foo");
        $this->assertEquals($result, "foo");

        $this->aop->register(new sample\After());
        $result = $this->target->mirror("foo");
        $this->assertEquals($result, "foo is overrided");
    }

    public function testCanInterceptAndChangeReturnValueInCustomeMethod()
    {
        $result = $this->target->custom();
        $this->assertEquals($result, "custom");

        $this->aop->register(new sample\After());
        $result = $this->target->custom();
        $this->assertEquals($result, "customisation in progress");
    }

    public function testCanInterceptWithMultiplePointCut()
    {
        $result = $this->target->mirror("foo");
        $this->assertEquals($result, "foo");

        $this->aop->register(new sample\After\Multiple());
        $result = $this->target->mirror("foo");
        $this->assertEquals($result, "foo is overrided");
        $result = $this->target->bar();
        $this->assertEquals($result, "bar is overrided");
    }
}
