<?php

namespace SimpleAOPTest\Advice\After;

use sample;
use SimpleAOPTest\Advice\AbstractAdviceTest;

class ActionTest extends AbstractAdviceTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->fooAction();
        $this->assertEquals($result, array('attr' => 'foo'));

        $this->aop->register(new sample\After\Action());
        $result = $this->target->fooAction();
        $this->assertEquals($result, "foo is overrided");
    }

    public function testCanInterceptAndChangeReturnValueInCustomeMethod()
    {
        $result = $this->target->customAction();
        $this->assertEquals($result, array('attr' => 'custom'));

        $this->aop->register(new sample\After\Action());
        $result = $this->target->customAction();
        $this->assertEquals($result, "customisation in progress");
    }
}
