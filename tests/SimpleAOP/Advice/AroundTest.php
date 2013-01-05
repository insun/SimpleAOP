<?php

namespace SimpleAOPTest\Advice;

use sample;

class AroundTest extends AbstractAdviceTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->foo('zend');
        $this->assertEquals($result, "zend");

        $this->aop->register(new sample\Around());
        $result = $this->target->foo('zend');
        $this->assertEquals($result, "before is overrided");
    }
}
