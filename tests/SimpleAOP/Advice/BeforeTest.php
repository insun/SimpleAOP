<?php

namespace SimpleAOPTest\Advice;

use sample;

class BeforeTest extends AbstractAdviceTest
{
    public function testCanInterceptAndSetArguments()
    {
        $result = $this->target->foo('zend');
        $this->assertEquals($result, 'zend');

        $this->aop->register(new sample\Before());
        $result = $this->target->foo('zend');
        $this->assertEquals($result, 'intercepted');
    }
}
