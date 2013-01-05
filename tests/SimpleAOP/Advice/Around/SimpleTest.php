<?php

namespace SimpleAOPTest\Advice\Around;

use sample;
use SimpleAOPTest\Advice\AbstractAdviceTest;

class SimpleTest extends AbstractAdviceTest
{
    public function testCanInterceptAndSetArguments()
    {
        $result = $this->target->foo('zend');
        $this->assertEquals($result, 'zend');

        $this->aop->register(new sample\Around\Simple());
        $result = $this->target->foo('zend');
        $this->assertEquals($result, 'before is overrided');
    }
}
