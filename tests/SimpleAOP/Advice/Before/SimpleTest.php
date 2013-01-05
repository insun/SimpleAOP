<?php

namespace SimpleAOPTest\Advice\Before;

use sample;
use SimpleAOPTest\Advice\AbstractAdviceTest;

class SimpleTest extends AbstractAdviceTest
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
