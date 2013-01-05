<?php

namespace SimpleAOPTest\Advice\After;

use sample;
use SimpleAOPTest\Advice\AbstractAdviceTest;

class SimpleTest extends AbstractAdviceTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->foo("foo");
        $this->assertEquals($result, "foo");

        $this->aop->register(new sample\After\Simple());
        $result = $this->target->foo("bar");
        $this->assertEquals($result, "bar is overrided");
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
