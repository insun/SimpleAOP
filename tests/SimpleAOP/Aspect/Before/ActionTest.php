<?php

namespace SimpleAOPTest\Aspect\Before;

use sample;
use SimpleAOPTest\Aspect\AbstractAspectTest;

class ActionTest extends AbstractAspectTest
{
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new \Zend\Http\Request();
        $this->aop->getServiceLocator()->setService('Request', $this->request);
    }

    public function testCanInterceptAndSetArguments()
    {
        $this->request->setMetadata('param1', 'bar');
        $this->target->fooAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'bar');

        $this->aop->register(new sample\Before\Action());
        $result = $this->target->fooAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'foo action is intercepted');
        $this->assertEquals($result, array('attr' => 'bar'));
    }

    public function testCanInterceptAndSetArgumentsInCustomeMethod()
    {
        $this->request->setMetadata('param1', 'bar');
        $result = $this->target->customAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'bar');

        $this->aop->register(new sample\Before\Action());
        $result = $this->target->customAction();
        $this->assertEquals($this->request->getMetaData('param1'), "custom in progress");
    }
}
