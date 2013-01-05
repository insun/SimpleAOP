<?php

namespace SimpleAOPTest\Advice;

use sample;

class AroundTest extends AbstractAdviceTest
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
