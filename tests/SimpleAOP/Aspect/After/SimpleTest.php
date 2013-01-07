<?php

namespace SimpleAOPTest\Aspect\After;

use sample;
use SimpleAOPTest\Aspect\AbstractAspectTest;

class SimpleTest extends AbstractAspectTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->mirror("foo");
        $this->assertEquals($result, "foo");

        $this->aop->register(new sample\After\Simple());
        $result = $this->target->mirror("bar");
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
