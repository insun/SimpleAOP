<?php

namespace SimpleAOPTest\Advice;

use sample;

class AfterTest extends AbstractAdviceTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->foo("foo");
        $this->assertEquals($result, "foo");

        $this->aop->register(new sample\After());
        $result = $this->target->foo("foo");
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
        $result = $this->target->foo("foo");
        $this->assertEquals($result, "foo");

        $this->aop->register(new sample\After\Multiple());
        $result = $this->target->foo("foo");
        $this->assertEquals($result, "foo is overrided");
        $result = $this->target->bar();
        $this->assertEquals($result, "bar is overrided");
    }
}
