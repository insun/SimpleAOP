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
}
