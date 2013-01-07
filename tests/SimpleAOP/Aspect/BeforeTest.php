<?php

namespace SimpleAOPTest\Aspect;

use sample;

class BeforeTest extends AbstractAspectTest
{
    public function testCanInterceptAndSetArguments()
    {
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, 'zend');

        $this->aop->register(new sample\Before());
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, 'intercepted');
    }

    public function testCanInterceptAndSetArgumentsInCustomeMethod()
    {
        $result = $this->target->custom();
        $this->assertEquals($result, "custom");

        $this->aop->register(new sample\Before());
        $result = $this->target->custom();
        $this->assertEquals($result, "custom in progress");
    }
}
