<?php

namespace SimpleAOPTest\Aspect\After;

use sample;
use SimpleAOPTest\Aspect\AbstractAspectTest;

class ActionTest extends AbstractAspectTest
{
    public function testCanInterceptAndChangeReturnValue()
    {
        $result = $this->target->fooAction('foo');
        $this->assertEquals($result, array('attr' => 'foo'));

        $this->aop->register(new sample\After\Action());
        $result = $this->target->fooAction('foo');
        $this->assertEquals($result, "foo is overrided");
    }

    public function testCanNotInterceptNoActionMethod()
    {
        $this->setExpectedException('Zend\Stdlib\Exception\InvalidArgumentException');
        $this->aop->register(new sample\After\Action\BadPointCut());
        $this->target->mirror('test');
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
