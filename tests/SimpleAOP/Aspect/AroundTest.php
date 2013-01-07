<?php

namespace SimpleAOPTest\Aspect;

use sample;

class AroundTest extends AbstractAspectTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, "zend");

        $this->aop->register(new sample\Around());
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, "intercepted is overrided");
    }

    public function testCanInterceptAndChangeReturnValueInCustomeMethod()
    {
        $result = $this->target->custom();
        $this->assertEquals($result, "custom");

        $this->aop->register(new sample\Around());
        $result = $this->target->custom();
        $this->assertEquals($result, "customisation in progress");
    }
}
