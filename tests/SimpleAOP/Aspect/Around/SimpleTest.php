<?php

namespace SimpleAOPTest\Aspect\Around;

use sample;
use SimpleAOPTest\Aspect\AbstractAspectTest;

class SimpleTest extends AbstractAspectTest
{
    public function testCanInterceptAndSetArguments()
    {
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, 'zend');

        $this->aop->register(new sample\Around\Simple());
        $result = $this->target->mirror('zend');
        $this->assertEquals($result, 'before is overrided');
    }

    public function testCanInterceptAndSetArgumentsInCustomMethod()
    {
        $result = $this->target->custom();
        $this->assertEquals($result, 'custom');

        $this->aop->register(new sample\Around\Simple());
        $result = $this->target->custom();
        $this->assertEquals($result, "customisation in progress");
    }
}
