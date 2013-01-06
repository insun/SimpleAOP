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
}
