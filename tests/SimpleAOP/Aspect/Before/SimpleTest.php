<?php

namespace SimpleAOPTest\Aspect\Before;

use sample;
use SimpleAOPTest\Aspect\AbstractAspectTest;

class SimpleTest extends AbstractAspectTest
{
    public function testCanInterceptAndSetArguments()
    {
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, 'zend');

        $this->aop->register(new sample\Before\Simple());
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, 'intercepted');
    }

    public function testCanInterceptAndSetArgumentsInCustomMethod()
    {
        $result = $this->target->custom();
        $this->assertEquals($result, 'custom');

        $this->aop->register(new sample\Before\Simple());
        $result = $this->target->custom();
        $this->assertEquals($result, 'customisation in progress');
    }
}
